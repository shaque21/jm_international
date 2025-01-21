<?php

namespace App\Http\Controllers;

use App\Models\Depo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class DepoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allDepos=Depo::where('depo_status',1)->orderBy('id','DESC')->get();
        
        // $allDepos = Depo::where('depo_status', 1)
        // ->whereHas('warehouse', function ($query) {
        //     $query->where('warehouse_status', 1);
        // })
        // ->orderBy('id', 'DESC')
        // ->get();
        return view('admin.depos.all',compact('allDepos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.depos.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([ 
            'depo_name'=>'required|max:70',
            // 'warehouse_id'=>'required',
            
        ]);
        $slug = Str::of($request->depo_name)->slug('-');
        $insert=Depo::insert([
            'depo_name'=>$request->depo_name,
            // 'warehouse_id'=>$request->warehouse_id,
            'depo_slug'=>$slug,
            'created_at'=>Carbon::now()->toDateTimeString(),
        ]);

        if($insert){
            $request->session()->flash('success', 'New Depo Added Successfully!');
            return redirect('/admin/depos/create');
        }
        else{
            $request->session()->flash('error', 'New Depo is not Added!');
            return redirect('/admin/depos/create');
        }
    }

    public function view($slug){
        $data=Depo::where('depo_status',1)->where('depo_slug',$slug)->get();
        return view('admin.depos.view',compact('data'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Depo $depo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Depo $depo, $slug)
    {
        $data=Depo::where('depo_status',1)->where('depo_slug',$slug)->firstOrFail();
        return view('admin.depos.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Depo $depo)
    {
        $request->validate([ 
            'depo_name'=>'required|max:70',
            // 'warehouse_id'=>'required',
            
        ]);
        $slug = Str::of($request->depo_name)->slug('-');
        

        $data=array(
            'depo_name'=>$request->depo_name,
            // 'warehouse_id'=>$request->warehouse_id,
            'depo_slug'=>$slug,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        );
        $update = DB::table('depos')->where('id',$request->id)->where('depo_status',1)->update($data);
        if($update){
            Session::flash('update_success','Depo Information Updated Successfully !');
            return redirect('/admin/depos/view/'.$slug);
        }
        else{
            Session::flash('update_error','The Depo Information is not Updated !');
            return redirect('/admin/depos/edit/'.$slug);
        }
    }

    public function soft_delete($slug){
        $soft_delete=Depo::where('depo_status',1)->where('depo_slug',$slug)
        ->update([
            'depo_status'=>0,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($soft_delete){
            Session::flash('delete_success','This Depo moves to Restore');
            return redirect('/admin/depos');
        }
        else{
            Session::flash('delete_error','This Depo can not moves to Restore');
            return redirect('/admin/depos');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Depo $depo)
    {
        //
    }
}
