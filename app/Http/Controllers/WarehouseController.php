<?php

namespace App\Http\Controllers;

use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allWarehouse=Warehouse::where('warehouse_status',1)->orderBy('id','DESC')->get();
        return view('admin.warehouses.all',compact('allWarehouse'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.warehouses.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([ 
            'name'=>'required|max:70',
            
        ]);
        $slug = Str::of($request->name)->slug('-');
        $insert=Warehouse::insert([
            'name'=>$request->name,
            'warehouse_slug'=>$slug,
            'created_at'=>Carbon::now()->toDateTimeString(),
        ]);

        if($insert){
            $request->session()->flash('success', 'New Warehouse Added Successfully!');
            return redirect('/admin/warehouses/create');
        }
        else{
            $request->session()->flash('error', 'New Warehouse is not Added!');
            return redirect('/admin/warehouses/create');
        }
    }

    public function view($slug){
        $data=Warehouse::where('warehouse_status',1)->where('warehouse_slug',$slug)->get();
        return view('admin.warehouses.view',compact('data'));
    }
    /**
     * Display the specified resource.
     */
    public function show(Warehouse $warehouse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Warehouse $warehouse,$slug)
    {
        $data=Warehouse::where('warehouse_status',1)->where('warehouse_slug',$slug)->firstOrFail();
        return view('admin.warehouses.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Warehouse $warehouse)
    {
        $request->validate([ 
            'name'=>'required|max:70',
            
        ]);
        $slug = Str::of($request->name)->slug('-');
        

        $data=array(
            'name'=>$request->name,
            'warehouse_slug'=>$slug,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        );
        $update = DB::table('warehouses')->where('id',$request->id)->where('warehouse_status',1)->update($data);
        if($update){
            Session::flash('update_success','Warehouse Information Updated Successfully !');
            return redirect('/admin/warehouses/view/'.$slug);
        }
        else{
            Session::flash('update_error','The Warehouse Information is not Updated !');
            return redirect('/admin/warehouse/edit/'.$slug);
        }
    }

    public function soft_delete($slug){
        $soft_delete=Warehouse::where('warehouse_status',1)->where('warehouse_slug',$slug)
        ->update([
            'warehouse_status'=>0,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($soft_delete){
            Session::flash('delete_success','This warehouse moves to Restore');
            return redirect('/admin/warehouses');
        }
        else{
            Session::flash('delete_error','This warehouse can not moves to Restore');
            return redirect('/admin/warehouses');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Warehouse $warehouse)
    {
        //
    }
}
