<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
// use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allProducts=Product::where('product_status',1)->orderBy('id','DESC')->get();
        return view('admin.products.all',compact('allProducts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([ 
            'product_name'=>'required|max:70',
            'generic_name'=>'required',
            'packing'=>'required',
            'quantity'=>'required',
            'alert_stock'=>'required',
            'specification'=>'required',
            'product_img'=>'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ],[
            'alert_stock.required'=>'The Stock Field is Required!',
            'product_img.required'=>'The Product Image Field is Required!',
        ]);

        // $image=$request->file('product_img');
        // $ext=$image->extension();
        // $file=time().'.'.$ext;
        // $image->storeAs("/public/uploads/products",$file);
        if ($request->hasFile('product_img')) {
            // Get the file from the request
            $image = $request->file('product_img');
    
            // Generate a unique name for the file
            $fileName = time() . '.' . $image->getClientOriginalExtension();
    
            // Store the file in the 'public/uploads/products' directory
            $path = $image->move(public_path('/uploads/products'), $fileName);
    
            // Store the file name or path in the database if needed
            // Product::create(['image_path' => $fileName]);
    
            // return back()->with('success', 'Image uploaded successfully.')->with('image', $fileName);
        }
    

        // $file = $request->file('product_img');
        // $imageName = time() . '.' . $file->getClientOriginalExtension();

        // // Resize and save using Intervention Image
        // $image = Image::make($file)->resize(300, 300)->encode();
        // Storage::put("public/uploads/products/{$imageName}", $image);

        $slug = Str::of($request->product_name)->slug('-');
        $insert=Product::insert([
            'product_name'=>$request->product_name,
            'generic_name'=>$request->generic_name,
            'packing'=>$request->packing,
            'quantity'=>$request->quantity,
            'alert_stock'=>$request->alert_stock,
            'specification'=>$request->specification,
            'product_img'=>$fileName,
            'product_slug'=>$slug,
            'created_at'=>Carbon::now()->toDateTimeString(),
        ]);

        if($insert){
            $request->session()->flash('success', 'New Product Added Successfully!');
            return redirect('/admin/products/create');
        }
        else{
            $request->session()->flash('error', 'New Product is not Added!');
            return redirect('/admin/products/create');
        }

    }

    
    public function view($slug){
        $data=Product::where('product_status',1)->where('product_slug',$slug)->get();
        return view('admin.products.view',compact('data'));
    }

    

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product,$slug)
    {
        $data=Product::where('product_status',1)->where('product_slug',$slug)->firstOrFail();
        return view('admin.products.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //return $request->all();
        $request->validate([
'product_name'=>'required|max:70',
            'generic_name'=>'required',
            'packing'=>'required',
            'quantity'=>'required',
            'alert_stock'=>'required',
            'specification'=>'required',
            'product_img'=>'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ],[
            'alert_stock.required'=>'The Stock Field is Required!',
            'product_img.required'=>'The Product Image Field is Required!',
        ]);

        
        $url_slug = Str::of($request->product_name)->slug('-');
        // $product_code = $request->product_code;

        $data=array(
            'product_name'=>$request->product_name,
            'generic_name'=>$request->generic_name,
            'packing'=>$request->packing,
            'quantity'=>$request->quantity,
            'alert_stock'=>$request->alert_stock,
            'specification'=>$request->specification,
            'product_slug'=>$url_slug,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        );
        //image file upload

        if($request->hasFile('product_img')){
            $image=$request->file('product_img');
            $ext=$image->extension();
            $file=time(). '-' . $request->product_name . '.' .$ext;
            $image->storeAs('/public/productImages',$file);
            $data['product_img']=$file;
        }
        if ($request->hasFile('product_img')) {
            // Get the file from the request
            $image = $request->file('product_img');
    
            // Generate a unique name for the file
            $fileName = time() . '.' . $image->getClientOriginalExtension();
    
            // Store the file in the 'public/uploads/products' directory
            $path = $image->move(public_path('/uploads/products'), $fileName);
            $data['product_img']=$fileName;
    
            // Store the file name or path in the database if needed
            // Product::create(['image_path' => $fileName]);
    
            // return back()->with('success', 'Image uploaded successfully.')->with('image', $fileName);
        }
        $update = DB::table('products')->where('id',$request->id)->where('product_status',1)->update($data);
        if($update){
            Session::flash('update_success','Product Information Updated Successfully !');
            return redirect('/admin/products/view/'.$url_slug);
        }
        else{
            Session::flash('update_error','The Product Information is not Updated !');
            return redirect('/admin/products/edit/'.$url_slug);
        }


    }

    public function soft_delete($slug){
        $soft_delete=Product::where('product_status',1)->where('product_slug',$slug)
        ->update([
            'product_status'=>0,
            'updated_at'=>Carbon::now()->toDateTimeString(),
        ]);
        if($soft_delete){
            Session::flash('delete_success','This product moves to Restore');
            return redirect('/admin/products');
        }
        else{
            Session::flash('delete_error','This product can not moves to Restore');
            return redirect('/admin/products');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
