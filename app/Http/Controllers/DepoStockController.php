<?php

namespace App\Http\Controllers;

use App\Models\DepoStock;
use App\Models\Warehouse;
use App\Models\WarehouseProductStock;
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

        // $total_stocks = WarehouseProductStock::orderBy('id','DESC')->get();
    
        // Pass data to the view
        return view('admin.depo_stocks.all', compact('stocks'));
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

                $request->session()->flash('stock_alert', 'Not enough stock in the warehouse.!');
                return redirect('/admin/depo_stocks/create');
                // return redirect('/admin/depo_stocks/create')->with('stock_alert', 'Not enough stock in the warehouse.!');

                // return back()->with('error', 'Not enough stock in the warehouse.');
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
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'user_id' => $user_id,
                'ds_slug' => $slug,
                'created_at' => Carbon::now()->toDateTimeString(),
            ]);
    
            DB::commit();
            
            $request->session()->flash('success', 'New Depo Stock Added Successfully!');
            return redirect('/admin/depo_stocks/create');
            // return back()->with('success', 'Depo stock added successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            $request->session()->flash('error', 'New Depo Stock is not Added!');
            return redirect('/admin/depo_stocks/create');
            // return back()->with('error', 'Failed to add depo stock: ' . $e->getMessage());
        }
    
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
    public function edit(DepoStock $depoStock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, DepoStock $depoStock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DepoStock $depoStock)
    {
        //
    }
}
