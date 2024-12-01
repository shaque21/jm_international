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

        $image=$request->file('product_img');
        $ext=$image->extension();
        $file=time().'.'.$ext;
        $image->storeAs("/public/uploads/products/{$file}",$file);

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
            'product_img'=>$file,
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
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
