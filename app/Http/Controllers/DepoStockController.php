<?php

namespace App\Http\Controllers;

use App\Models\DepoStock;
use App\Models\Warehouse;
use App\Models\User;
use App\Models\Depo;
use App\Models\WarehouseProductStock;
use App\Models\DepoProductStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class DepoStockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stocks = DepoStock::where('ds_status', 1)
        ->whereHas('depo', function ($query) {
            $query->where('depo_status', 1);
        })
        ->orderBy('id', 'DESC')
        ->get();
        
        $total_stocks = DepoProductStock::orderBy('id','DESC')->get();
        // dd($total_stocks);
        // Pass data to the view
        return view('admin.depo_stocks.all', compact('stocks','total_stocks'));
    }
    public function emp_depo_stocks()
    {
        $employeeId = Auth::user()->id;

        // Get Depo Stocks where the employee works
        $stocks = DepoStock::with('depo') 
            ->where('ds_status', 1)
            ->where('employee_id', $employeeId)
            ->whereHas('depo', function ($query) {
                $query->where('depo_status', 1);
            })
            ->orderBy('id', 'DESC')
            ->get();

        // Fetch total Depo Product Stocks for the employee's depo
        $depoIds = $stocks->pluck('depo_id')->unique(); // Get unique depo IDs
        $total_stocks = DepoProductStock::whereIn('depo_id', $depoIds)
            ->orderBy('id', 'DESC')
            ->get();

        // dd($total_stocks);
        // Pass data to the view
        return view('admin.depo_stocks.emp_all', compact('stocks','total_stocks'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('admin.depo_stocks.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    
    public function store(Request $request)
    {
        $request->validate([
            'depo_id' => 'required|exists:depos,id',
            'employee_id' => 'required|exists:users,id',
            'warehouse_id' => 'required|exists:warehouses,id',
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        try {
            DB::beginTransaction();

            // Check if stock exists in warehouse_product_stocks
            $warehouseStock = WarehouseProductStock::where('warehouse_id', $request->warehouse_id)
                ->where('product_id', $request->product_id)
                ->first();

                if (!$warehouseStock || $warehouseStock->total_stock < $request->quantity) {
                    return redirect()->back()->with('error_h', 'Not enough stock in the warehouse!');
                    // return redirect()->back()->with('stock_alert', 'Not enough stock in the warehouse!');
                }
                

            // Deduct quantity from warehouse stock
            $warehouseStock->total_stock -= $request->quantity;
            $warehouseStock->save();

            // Create depo_stock record
            $user_id = Auth::user()->id;
            $slug = Str::of(time())->slug('-');
            DepoStock::create([
                'depo_id' => $request->depo_id,
                'warehouse_id' => $request->warehouse_id,
                'employee_id' => $request->employee_id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'user_id' => $user_id,
                'ds_slug' => $slug,
                'created_at' => Carbon::now()->toDateTimeString(),
            ]);

            // Check if ProductStock exists for this product
            $productStock = DepoProductStock::where('product_id', $request->product_id)
                ->where('depo_id', $request->depo_id)
                ->first();

            if ($productStock) {
                // Update the total stock
                $productStock->total_stock += $request->quantity;
                $productStock->save();
            } else {
                // Create a new product stock record
                DepoProductStock::create([
                    'product_id' => $request->product_id,
                    'depo_id' => $request->depo_id,
                    'total_stock' => $request->quantity,
                ]);
            }

            DB::commit();
            return back()->with('success', 'New Depo Stock Added Successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to add depo stock: ' . $e->getMessage());
        }
    }


    public function view($slug){
        $data = DepoStock::where('ds_status',1)
                                ->where('ds_slug',$slug)
                                ->get();

        // Pass data to the view
        return view('admin.depo_stocks.view', compact('data'));
    }

    /**
     * Display the specified resource.
     */
    public function show(DepoStock $depoStock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DepoStock $depoStock,$slug)
    {
        $data=DepoStock::where('ds_status',1)->where('ds_slug',$slug)->firstOrFail();
        return view('admin.depo_stocks.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DepoStock $depoStock)
    {
        $request->validate([
            'depo_id' => 'required|exists:depos,id',
            'warehouse_id' => 'required|exists:warehouses,id',
            'product_id' => 'required|exists:products,id',
            'employee_id' => 'required|exists:users,id',
            'quantity' => 'required|integer|min:1',
        ]);
    
        try {
            DB::beginTransaction();
    
            $warehouseStock = WarehouseProductStock::where('warehouse_id', $request->warehouse_id)
                ->where('product_id', $request->product_id)
                ->first();
            
            if (!$warehouseStock) {
                return redirect()->back()->with('stock_alert', 'No stock record found for the selected warehouse and product.');
            }
            
            $depoStock = DepoStock::where('ds_status',1)->where('id',$request->id)->first();
            // dd($depoStock);
            // Calculate the quantity difference
            $quantityDifference = $request->quantity - $depoStock->quantity;
            // dd($quantityDifference);
            // Ensure warehouse has enough stock if quantityDifference is positive
            if ($quantityDifference > 0 && $warehouseStock->total_stock < $quantityDifference) {
                return redirect()->back()->with('stock_alert', 'Not enough stock available in the warehouse.');
            }
    
            // Adjust warehouse stock
            $warehouseStock->total_stock -= $quantityDifference;
            $warehouseStock->save();
    
            // Update depo_stock record
            $user_id = Auth::user()->id;
            $slug = Str::of(time())->slug('-');
            $depoStock->update([
                'depo_id' => $request->depo_id,
                'warehouse_id' => $request->warehouse_id,
                'employee_id' => $request->employee_id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'user_id' => $user_id,
                'ds_slug' => $slug,
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]);

            // Find the associated DepoProductStock
            $productStock = DepoProductStock::where('product_id', $request->product_id)
                ->where('depo_id', $request->depo_id)
                ->first();

            if ($productStock) {
                // Adjust the total stock
                $productStock->total_stock += $quantityDifference;
                $productStock->save();
            } else {
                // If no record exists, create one
                DepoProductStock::create([
                    'depo_id' => $request->warehouse_id,
                    'product_id' => $request->product_id,
                    'total_stock' => $request->quantity,
                ]);
            }
    
            DB::commit();
    
            return redirect('/admin/depo_stocks')->with('success', 'Depo Stock updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
    
            return redirect()->back()->with('error', 'Failed to update Depo Stock: ' . $e->getMessage());
        }
    
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DepoStock $depoStock)
    {
        //
    }
}
