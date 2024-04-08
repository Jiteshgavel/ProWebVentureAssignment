<?php

namespace App\Http\Controllers\Front;

use App\Models\Product;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(){
        ActivityLog::createViewLog();
        $products = Product::with('category')->paginate(6);
       return view('welcome',compact('products'));

    }

    public function show($id){
       
        $product = Product::where('id', $id)->with('category')->first();
        if(!empty($product)){
            ActivityLog::createViewLog($id);
            return view('product_details', compact('product'));
        }

        return redirect()->route('home');
       
    }
}
