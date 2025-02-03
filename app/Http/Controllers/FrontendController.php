<?php

namespace App\Http\Controllers;
use App\Models\Product;

use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home()
    {
        $products = Product::where('product_status',1)->get();
        return view('welcome',compact('products'));
    }
}
