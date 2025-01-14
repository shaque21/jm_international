<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allCustomers=Customer::where('status',1)->orderBy('id','DESC')->get();
        return view('admin.customers.all',compact('allCustomers')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.customers.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|max:70|min:5',
            'mobile'=>'required|min:11|max:15',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'shop_name' => 'required',
            'address' => 'required',

            'photo'=>'mimes:jpeg,jpg,png,gif',
        ],[
            'name.required'=>'The name field is required!'
        ]);

         
        if ($request->hasFile('photo')) {
            // Get the file from the request
            $image = $request->file('photo');
    
            // Generate a unique name for the file
            $fileName = time() . '.' . $image->getClientOriginalExtension();
    
            // Store the file in the 'public/uploads/customers' directory
            $path = $image->move(public_path('/uploads/customers'), $fileName);
    
            
        }
    

        $slug = Str::of($request->name)->slug('-');
        $insert=Customer::insert([
            'name'=>$request->name,
            'email'=>$request->email,
            'mobile'=>$request->mobile,
            'shop_name'=>$request->shop_name,
            'address'=>$request->address,
            'password' => Hash::make($request->password),
            'slug'=>$slug,
            'photo'=>$fileName,
            'created_at'=>Carbon::now()->toDateTimeString(),
        ]);

        if($insert){
            $request->session()->flash('success', 'New Customer Added Successfully!');
            return redirect('/admin/customers/create');
        }
        else{
            $request->session()->flash('error', 'New Customer is not Added!');
            return redirect('/admin/customers/create');
        }
    }

    public function view($slug){
        $data=Customer::where('status',1)->where('slug',$slug)->get();
        // return $data->created_at;
        return view('admin.customers.view',compact('data'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer,$slug)
    {
        $data=Customer::where('status',1)->where('slug',$slug)->firstOrFail();
        return view('admin.customers.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'name'=>'required|max:70|min:5',
            'mobile'=>'required|min:11|max:15',
            'email' => 'required|string|email|max:255|unique:users',
            //'password' => 'required|string|min:8',
            'shop_name' => 'required',
            'address' => 'required',

            'photo'=>'mimes:jpeg,jpg,png,gif',
        ],[
            'name.required'=>'The name field is required!'
        ]);

        $slug = Str::of($request->name)->slug('-');

        $data = array(
            'name'=>$request->name,
            'email'=>$request->email,
            'mobile'=>$request->mobile,
            'shop_name'=>$request->shop_name,
            'address'=>$request->address,
            //'password' => Hash::make($request->password),
            'slug'=>$slug,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        );
        if ($request->hasFile('photo')) {
            // Get the file from the request
            $image = $request->file('photo');
    
            // Generate a unique name for the file
            $fileName = time() . '.' . $image->getClientOriginalExtension();
    
            // Store the file in the 'public/uploads/customers' directory
            $path = $image->move(public_path('/uploads/customers'), $fileName);
            $data['photo'] = $fileName;
            
        }
        $update = DB::table('customers')->where('id',$request->id)->where('status',1)->update($data);
        if($update){
            Session::flash('update_success','Customer Information Updated Successfully !');
            return redirect('/admin/customers/view/'.$slug);
        }
        else{
            Session::flash('update_error','The Customer Information is not Updated !');
            return redirect('/admin/customers/edit/'.$slug);
        }


    }

    public function soft_delete($slug){
        $soft_delete=Customer::where('status',1)->where('slug',$slug)
        ->update([
            'status'=>0,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($soft_delete){
            Session::flash('delete_success','This customer moves to Restore');
            return redirect('/admin/customers');
        }
        else{
            Session::flash('delete_error','This customer can not moves to Restore');
            return redirect('/admin/customers');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
