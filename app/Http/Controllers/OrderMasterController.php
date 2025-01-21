<?php

namespace App\Http\Controllers;

use App\Models\OrderMaster;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\OrderDetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class OrderMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::where('product_status',1)->orderBy('product_name','ASC')->get();
        $orders = OrderMaster::all();
        return view('admin.orders.index',compact('products','orders'));
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
        // Validate the order input
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'ordered_qty' => 'required|min:1',
            'delivered_qty' => 'required|min:1',
            'customer_id' => 'required|exists:users,id',
        ]);
        
        $user = Auth::user();
        $order_date = Carbon::now()->format('Y-m-d');
        $invoiceNo = 'ORD-' . date('Ymd') . '_' . $request->customer_id . '_' . rand(10000, 99999);

        echo $invoiceNo;die();

        // Start a database transaction
        DB::beginTransaction();

        try {
            // Create a new order master
            $orderMaster = new OrderMaster();
            $orderMaster->user_id = $user->id;
            if($user->isAmin() || $user->isEmployee())
            {
                $orderMaster->order_status = 1;
            }
            else
            {
                $orderMaster->order_status = 0;  // Order status 0 (Pending)
            }
            $orderMaster->save();

            // Loop through each order detail and create OrderDetail
            foreach ($validated['order_details'] as $detail) {
                $orderDetail = new OrderDetail();
                $orderDetail->order_master_id = $orderMaster->id;
                $orderDetail->product_id = $detail['product_id'];
                $orderDetail->quantity = $detail['quantity'];
                $orderDetail->save();

                // Deduct stock based on the user role (Admin or Employee)
                if ($user->isAdmin()) {
                    // Deduct from WarehouseProductStock
                    $warehouseStock = WarehouseProductStock::where('product_id', $detail['product_id'])->first();
                    if ($warehouseStock && $warehouseStock->quantity >= $detail['quantity']) {
                        $warehouseStock->quantity -= $detail['quantity'];
                        $warehouseStock->save();
                    } else {
                        // If stock is not sufficient, rollback and return error
                        DB::rollBack();
                        return back()->with('error', 'Not enough stock in the warehouse.');
                    }
                } elseif ($user->isEmployee()) {
                    // Deduct from DepoProductStock
                    $depoStock = DepoProductStock::where('product_id', $detail['product_id'])
                                                ->where('depo_id', $user->depo_id)
                                                ->first();
                    if ($depoStock && $depoStock->quantity >= $detail['quantity']) {
                        $depoStock->quantity -= $detail['quantity'];
                        $depoStock->save();
                    } else {
                        // If stock is not sufficient, rollback and return error
                        DB::rollBack();
                        return back()->with('error', 'Not enough stock in the depo.');
                    }
                } else {
                    // If user role is invalid, rollback and return error
                    DB::rollBack();
                    return back()->with('error', 'Invalid user role for stock deduction.');
                }
            }

            // Commit the transaction
            DB::commit();

            // Return success message
            $request->session()->flash('success', 'Order placed successfully.!');
            return redirect('/admin/orders');
            // return redirect()->route('orders.index')->with('success', 'Order placed successfully.');
        } catch (\Exception $e) {
            // Rollback if any exception occurs
            DB::rollBack();
            // Log the exception for debugging (optional)
            $request->session()->flash('error', 'Something went wrong. Please try again.');
            return redirect('/admin/orders');
            // Log::error('Order placement failed: ' . $e->getMessage());
            // return back()->with('error', 'Something went wrong. Please try again.');
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
