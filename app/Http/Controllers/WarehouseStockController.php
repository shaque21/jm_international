<?php

namespace App\Http\Controllers;

use App\Models\WarehouseStock;
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
        //$allStocks=WarehouseStock::where('sup_status',1)->orderBy('id','DESC')->get();
        // Eager load the relationships: warehouse, supplier, product, user
        $stocks = WarehouseStock::where('wr_status',1)
                                ->orderBy('id', 'DESC')
                                ->get();

        // Pass data to the view
        return view('admin.warehouse_stocks.all', compact('stocks'));
        // return view('admin.warehouse_stocks.all');
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
       // return $request->all();
        $request->validate([
            'warehouse_id'=>'required',
            'supplier_id'=>'required',
            'product_id' => 'required',
            'quantity' => 'required',
            'alert_stock' => 'required',
        ],[
            'name.required'=>'The name field is required!'
        ]);
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in first.');
        }
    
        // Get the authenticated user's ID
        $user_id = Auth::user()->id;
        $slug = Str::of(time())->slug('-');
        // dd($slug);
        $insert=WarehouseStock::insert([
            'warehouse_id'=>$request->warehouse_id,
            'supplier_id'=>$request->supplier_id,
            'product_id'=>$request->product_id,
            'user_id'=>$user_id,
            'quantity'=>$request->quantity,
            'alert_stock'=>$request->alert_stock,
            'wr_slug' => $slug,
            'created_at'=>Carbon::now()->toDateTimeString(),
        ]);

        if($insert){
            $request->session()->flash('success', 'New Warehouse Stock is Added Successfully!');
            return redirect('/admin/warehouse_stocks/create');
        }
        else{
            $request->session()->flash('error', 'New Warehouse Stock is not Added!');
            return redirect('/admin/warehouse_stocks/create');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WarehouseStock $warehouseStock)
    {
        //
    }
}
