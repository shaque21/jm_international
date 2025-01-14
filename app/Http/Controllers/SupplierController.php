<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allSuppliers=Supplier::where('sup_status',1)->orderBy('id','DESC')->get();
        return view('admin.suppliers.all',compact('allSuppliers')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.suppliers.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'sup_name'=>'required|max:70|min:5',
            'mobile'=>'required|min:11|max:15',
            'email' => 'required|string|email|max:255',
            'company_name' => 'required',
            'address' => 'required',

            'sup_photo'=>'mimes:jpeg,jpg,png,gif',
        ],[
            'name.required'=>'The name field is required!'
        ]);

         
        if ($request->hasFile('sup_photo')) {
            // Get the file from the request
            $image = $request->file('sup_photo');
    
            // Generate a unique name for the file
            $fileName = time() . '.' . $image->getClientOriginalExtension();
    
            // Store the file in the 'public/uploads/customers' directory
            $path = $image->move(public_path('/uploads/suppliers'), $fileName);
    
            
        }
    

        $slug = Str::of($request->sup_name)->slug('-');
        $insert=Supplier::insert([
            'sup_name'=>$request->sup_name,
            'email'=>$request->email,
            'mobile'=>$request->mobile,
            'company_name'=>$request->company_name,
            'address'=>$request->address,
            'sup_slug'=>$slug,
            'sup_photo'=>$fileName,
            'created_at'=>Carbon::now()->toDateTimeString(),
        ]);

        if($insert){
            $request->session()->flash('success', 'New Supplier Added Successfully!');
            return redirect('/admin/suppliers/create');
        }
        else{
            $request->session()->flash('error', 'New Supplier is not Added!');
            return redirect('/admin/suppliers/create');
        }
    }

    public function view($slug){
        $data=Supplier::where('sup_status',1)->where('sup_slug',$slug)->get();
        return view('admin.suppliers.view',compact('data'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier,$slug)
    {
        $data=Supplier::where('sup_status',1)->where('sup_slug',$slug)->firstOrFail();
        return view('admin.suppliers.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'sup_name'=>'required|max:70|min:5',
            'mobile'=>'required|min:11|max:15',
            'email' => 'required|string|email|max:255',
            'company_name' => 'required',
            'address' => 'required',

            'sup_photo'=>'mimes:jpeg,jpg,png,gif',
        ],[
            'name.required'=>'The name field is required!'
        ]);

        $slug = Str::of($request->sup_name)->slug('-');

        $data = array(
            'sup_name'=>$request->sup_name,
            'email'=>$request->email,
            'mobile'=>$request->mobile,
            'company_name'=>$request->company_name,
            'address'=>$request->address,
            'sup_slug'=>$slug,
            // 'sup_photo'=>$fileName,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        );
        if ($request->hasFile('sup_photo')) {
            // Get the file from the request
            $image = $request->file('sup_photo');
    
            // Generate a unique name for the file
            $fileName = time() . '.' . $image->getClientOriginalExtension();
    
            // Store the file in the 'public/uploads/customers' directory
            $path = $image->move(public_path('/uploads/suppliers'), $fileName);
            $data['sup_photo'] = $fileName;
            
        }
        $update = DB::table('suppliers')->where('id',$request->id)->where('sup_status',1)->update($data);
        if($update){
            Session::flash('update_success','Supplier Information Updated Successfully !');
            return redirect('/admin/suppliers/view/'.$slug);
        }
        else{
            Session::flash('update_error','The Supplier Information is not Updated !');
            return redirect('/admin/suppliers/edit/'.$slug);
        }
    }

    public function soft_delete($slug){
        $soft_delete=Supplier::where('sup_status',1)->where('sup_slug',$slug)
        ->update([
            'sup_status'=>0,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($soft_delete){
            Session::flash('delete_success','This Supplier moves to Restore');
            return redirect('/admin/suppliers');
        }
        else{
            Session::flash('delete_error','This Supplier can not moves to Restore');
            return redirect('/admin/suppliers');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        //
    }
}
