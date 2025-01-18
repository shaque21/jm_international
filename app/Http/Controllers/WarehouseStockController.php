<?php

namespace App\Http\Controllers;

use App\Models\WarehouseStock;
use App\Models\Warehouse;
use App\Models\WarehouseProductStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
// use Illuminate\Support\Facades\Auth;


class WarehouseStockController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
       
        $stocks = WarehouseStock::where('wr_status', 1)
        ->whereHas('warehouse', function ($query) {
            $query->where('warehouse_status', 1);
        })
        ->orderBy('id', 'DESC')
        ->get();

        $total_stocks = WarehouseProductStock::orderBy('id','DESC')->get();
    
        // Pass data to the view
        return view('admin.warehouse_stocks.all', compact('stocks','total_stocks'));
    
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.warehouse_stocks.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        // Validate request data
        $request->validate([
            'warehouse_id' => 'required|exists:warehouses,id',
            'product_id' => 'required|exists:products,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'quantity' => 'required|numeric|min:1',
        ]);

        

        try {
            // Start a database transaction
            DB::beginTransaction();
            $user_id = Auth::user()->id;
            $slug = Str::of(time())->slug('-');
            // dd($slug);
            // Insert a new warehouse stock entry
            $warehouseStock = WarehouseStock::create([
                'warehouse_id' => $request->warehouse_id,
                'product_id' => $request->product_id,
                'supplier_id' => $request->supplier_id,
                'quantity' => $request->quantity,
                // 'alert_stock' => $request->alert_stock,
                'user_id' => $user_id, // Assuming the authenticated user
                'wr_slug' => $slug,
                'created_at'=>Carbon::now()->toDateTimeString(),
            ]);

            // Check if ProductStock exists for this product
            $productStock = WarehouseProductStock::where('product_id', $request->product_id)
                ->where('warehouse_id', $request->warehouse_id)
                ->first();

            if ($productStock) {
                // Update the total stock
                $productStock->total_stock += $request->quantity;
                $productStock->save();
            } else {
                // Create a new product stock record
                WarehouseProductStock::create([
                    'product_id' => $request->product_id,
                    'warehouse_id' => $request->warehouse_id,
                    'total_stock' => $request->quantity,
                ]);
            }

            // Commit the transaction
            DB::commit();

            $request->session()->flash('success', 'New Warehouse Stock is Added Successfully!');
            return redirect('/admin/warehouse_stocks/create');

            // return redirect()->back()->with('success', 'Stock added successfully!');
        } catch (\Exception $e) {
            // Rollback the transaction on error
            DB::rollBack();

            $request->session()->flash('error', 'New Warehouse Stock is not Added!');
            return redirect('/admin/warehouse_stocks/create');

            // return redirect()->back()->with('error', 'Failed to add stock: ' . $e->getMessage());
        }

    }
        
    public function view($slug){
        // $data=Supplier::where('sup_status',1)->where('sup_slug',$slug)->get();
        // return view('admin.suppliers.view',compact('data'));
        $data = WarehouseStock::where('wr_status',1)
                                ->where('wr_slug',$slug)
                                ->get();

        // Pass data to the view
        return view('admin.warehouse_stocks.view', compact('data'));
    }
   

    /**
     * Display the specified resource.
     */
    public function show(WarehouseStock $warehouseStock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WarehouseStock $warehouseStock,$slug)
    {
        $data=WarehouseStock::where('wr_status',1)->where('wr_slug',$slug)->firstOrFail();
        return view('admin.warehouse_stocks.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WarehouseStock $warehouseStock)
    {
        // Validate the request
        $request->validate([
            'warehouse_id' => 'required|exists:warehouses,id',
            'product_id' => 'required|exists:products,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'quantity' => 'required|numeric|min:1',
        ]);

        try {
            // Start a database transaction
            DB::beginTransaction();

            // Find the warehouse stock record by slug
            $warehouseStock = WarehouseStock::where('id',$request->id)->firstOrFail();

            // Calculate the quantity difference
            $quantityDifference = $request->quantity - $warehouseStock->quantity;
            $user_id = Auth::user()->id;
            $slug = Str::of(time())->slug('-');
            // Update the warehouse stock record
            $warehouseStock->update([
                'warehouse_id' => $request->warehouse_id,
                'product_id' => $request->product_id,
                'supplier_id' => $request->supplier_id,
                'quantity' => $request->quantity,
                'user_id' => $user_id,
                'wr_slug' => $slug,
                'updated_at'=>Carbon::now()->toDateTimeString(),
            ]);

            // Find the associated WarehouseProductStock
            $productStock = WarehouseProductStock::where('product_id', $request->product_id)
                ->where('warehouse_id', $request->warehouse_id)
                ->first();

            if ($productStock) {
                // Adjust the total stock
                $productStock->total_stock += $quantityDifference;
                $productStock->save();
            } else {
                // If no record exists, create one
                WarehouseProductStock::create([
                    'warehouse_id' => $request->warehouse_id,
                    'product_id' => $request->product_id,
                    'total_stock' => $request->quantity,
                ]);
            }

            // Commit the transaction
            DB::commit();

            // Return success response
            $request->session()->flash('success', 'Warehouse Stock updated successfully!');
            return redirect('/admin/warehouse_stocks');

        } catch (\Exception $e) {
            // Rollback the transaction on error
            DB::rollBack();

            // Return error response
            $request->session()->flash('error', 'Failed to update Warehouse Stock: ' . $e->getMessage());
            return redirect()->back();
        }

    }

    /**
     * Soft Delete
     */
    public function soft_delete($slug)
    {
        // Find the warehouse stock record by its slug
        $warehouseStock = WarehouseStock::where('wr_slug', $slug)->firstOrFail();

        // Check if the stock is already soft-deleted
        if ($warehouseStock->wr_status == 0) {
            session()->flash('delete_error', 'This warehouse stock is already deleted.');
            return redirect('/admin/warehouse_stocks');
        }

        // Get the related product stock
        $productStock = WarehouseProductStock::where('product_id', $warehouseStock->product_id)
                                            ->where('warehouse_id', $warehouseStock->warehouse_id)
                                            ->first();

        if ($productStock) {
            // Decrement the total stock by the quantity of the warehouse stock being soft-deleted
            $productStock->total_stock -= $warehouseStock->quantity;
            // Ensure total stock does not go negative
            $productStock->total_stock = max(0, $productStock->total_stock);
            $productStock->save();
        }

        // Soft delete the warehouse stock by updating the status to 0
        $warehouseStock->update([
            'wr_status' => 0,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);

        // Flash success message to the session
        session()->flash('delete_success', 'Warehouse Stock successfully soft deleted.');

        // Redirect to the listing page or back to where you need
        return redirect('/admin/warehouse_stocks');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WarehouseStock $warehouseStock)
    {
        //
    }
}
