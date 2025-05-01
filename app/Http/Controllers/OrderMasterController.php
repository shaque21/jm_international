<?php

namespace App\Http\Controllers;

use App\Models\OrderMaster;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\OrderDetail;
use App\Models\WarehouseProductStock;
use App\Models\DepoProductStock;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class OrderMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::where('product_status', 1)->orderBy('product_name', 'ASC')->get();
        $orders = OrderMaster::all();
        return view('admin.orders.index', compact('products', 'orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // return $request->all();
        // Validate the input
        $validated = $request->validate([
            'product_id' => 'required|array',
            'product_id.*' => 'exists:products,id',
            'ordered_qty' => 'required|array',
            'ordered_qty.*' => 'min:1',
            'delivered_qty' => 'required|array',
            'delivered_qty.*' => 'min:1',
            'customer_id' => 'required|exists:users,id',
        ]);

        $user = Auth::user();
        $order_date = date('Y-m-d');
        $invoiceNo = 'ORD-' . date('Ymd') . '_' . $request->customer_id . '_' . rand(10000, 99999);
        $num_of_item = array_sum($request->delivered_qty);

        DB::beginTransaction();
        try {
            Log::info("Starting transaction for order creation.");

            // Create a new OrderMaster
            $orderMaster = new OrderMaster();
            $orderMaster->user_id = $user->id;
            $orderMaster->customer_id = $request->customer_id;
            $orderMaster->warehouse_id = $request->warehouse_id;
            $orderMaster->depo_id = $request->depo_id;
            $orderMaster->invoice_no = $invoiceNo;
            $orderMaster->order_date = $order_date;
            $orderMaster->num_of_item = $num_of_item;
            $orderMaster->order_status = ($user->role_id == 1 || $user->role_id == 2) ? 1 : 0; // Set status

            $orderMaster->save();
            // dd($orderMaster);
            Log::info("OrderMaster created with ID: {$orderMaster->id}");

            // Loop through products and handle order details
            foreach ($request->product_id as $index => $productId) {
                $orderedQty = $request->ordered_qty[$index];
                $deliveredQty = $request->delivered_qty[$index];

                // Create OrderDetails
                $orderDetails = new OrderDetail();
                $orderDetails->order_master_id = $orderMaster->id;
                $orderDetails->product_id = $productId;
                $orderDetails->ordered_qty = $orderedQty;
                $orderDetails->delivered_qty = $deliveredQty;
                $orderDetails->save();
                // dd($orderDetails);
                Log::info("OrderDetails created for product ID: {$productId}");

                // Stock Deduction Logic
                if ($user->role_id == 1) {
                    $warehouseStock = WarehouseProductStock::where('product_id', $productId)->first();
                    if ($warehouseStock && $warehouseStock->total_stock >= $deliveredQty) {
                        $warehouseStock->total_stock -= $deliveredQty;
                        $warehouseStock->save();
                    } else {
                        throw new \Exception("Not enough stock in the warehouse for product ID: {$productId}");
                    }
                } elseif ($user->role_id == 2) {
                    $depoStock = DepoProductStock::where('product_id', $productId)
                        ->where('depo_id', $request->depo_id)
                        ->first();
                    if ($depoStock && $depoStock->total_stock >= $deliveredQty) {
                        $depoStock->total_stock -= $deliveredQty;
                        $depoStock->save();
                    } else {
                        throw new \Exception("Not enough stock in the depo for product ID: {$productId}");
                    }
                } elseif ($user->role_id == 3) {
                    // For role_id 3, set is_approved to 0 and skip stock deduction
                    $orderMaster->order_status = 0; // Assuming $orderMaster is the instance of OrderMaster
                    $orderMaster->save();
                } else {
                    throw new \Exception("Invalid user role: {$user->role_id}");
                }
            }

            DB::commit();
            Log::info("Transaction committed successfully for OrderMaster ID: {$orderMaster->id}");

            $request->session()->flash('success', 'Order placed successfully!');
            return redirect('/admin/orders');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Transaction failed: {$e->getMessage()}", ['stack' => $e->getTraceAsString()]);
            $request->session()->flash('error', 'An error occurred: ' . $e->getMessage());
            return back()->withInput();
        }
    }

    //Get Last Order History

    public function getLastOrderHistory(Request $request)
    {
        $user_id = Auth::user()->id;
        $user_id = Auth::user()->id;
        // Fetch the last order ID (or use max order ID if none provided)
        $lastOrder = OrderMaster::where('user_id', $user_id)
                    ->orderBy('id', 'desc')
                    ->select('id')
                    ->first();

        // Fetch the order with the relationships loaded
        $orderReceipt = OrderMaster::with([
            'orderDetails.product',
            'creator',
            'warehouse',
            'depo',
            'customer'
        ])
            ->where('id', $lastOrder->id?? '')
            ->where('user_id', $user_id)
            ->get();

        // If no order found, return a message
        if ($orderReceipt->isEmpty()) {
            return response('<p>No order history found.</p>', 200, ['Content-Type' => 'text/html']);
        }

        // Generate the HTML for the table
        $html = '
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover table-sm">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Qty</th>
                        <th>Ordered By</th>
                        <th>Delivered By</th>
                        <th>Delivered From</th>
                        <th>Order Status</th>
                    </tr>
                </thead>
                <tbody>';

        foreach ($orderReceipt as $key => $order) {
            $statusBadge = '';
            if ($order->order_status == 1) {
                $statusBadge = '<span class="badge badge-success">Delivered</span>';
            } else {
                $statusBadge = '<span class="badge badge-warning">Pending</span>';
            }

            // Loop through order details
            foreach ($order->orderDetails as $detail) {
                $html .= '
                    <tr class="text-center">
                        <td>' . ($key + 1) . '</td>
                        <td>' . ($detail->product->product_name ?? 'N/A') . '</td>
                        <td>' . $detail->delivered_qty . '</td>
                        <td>' . ($order->customer->name ?? 'N/A') . '</td>
                        <td><span class="badge badge-success">' . ($order->creator->name ?? 'N/A') . '</span></td>
                        <td>' . ($order->warehouse->name ?? $order->depo->depo_name ?? 'N/A') . '</td>
                        <td>' . $statusBadge . '</td>
                    </tr>';
            }
        }

        $html .= '
                </tbody>
            </table>
        </div>';

        return response($html, 200, ['Content-Type' => 'text/html']);
    }

    public function cancelOrder($orderMasterId)
    {
        DB::beginTransaction();

        try {
            $orderMaster = OrderMaster::with('orderDetails')->findOrFail($orderMasterId);

            if ($orderMaster->order_status == 0) {
                return back()->with('error', 'Order is already canceled.');
            }

            foreach ($orderMaster->orderDetails as $detail) {
                $productId = $detail->product_id;
                $qty = $detail->delivered_qty;

                $user = $orderMaster->creator ?? $orderMaster->user; // fallback
                $role = $user->role_id ?? null;

                if ($role === 1) {
                    // Warehouse return
                    $stock = WarehouseProductStock::firstOrCreate(['product_id' => $productId]);
                    $stock->total_stock += $qty;
                    $stock->save();
                } elseif ($role === 2) {
                    // Depo return
                    $stock = DepoProductStock::firstOrCreate([
                        'product_id' => $productId,
                        'depo_id' => $orderMaster->depo_id,
                    ]);
                    $stock->total_stock += $qty;
                    $stock->save();
                }
                // For customer (role 3), no stock update
            }

            $orderMaster->order_status = 0;
            $orderMaster->save();

            DB::commit();
            return back()->with('success', 'Order canceled and stock returned successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error canceling order: ' . $e->getMessage());
        }
    }




    /**
     * Display the specified resource.
     */
    public function show(OrderMaster $orderMaster)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrderMaster $orderMaster)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OrderMaster $orderMaster)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderMaster $orderMaster)
    {
        //
    }
}
