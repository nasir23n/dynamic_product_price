<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductStock;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function add(Request $request) {
        // $varient = ProductStock::where('sku', implode('-', $request->variation))->first();
        $product = Product::with('stock')->find($request->product_id);

        $str = '';
        foreach ($product->attributes as $key => $item) {
            if($str != null){
                $str .= '-'.str_replace(' ', '', $request['variation_'.$key]);
            }
            else{
                $str .= str_replace(' ', '', $request['variation_'.$key]);
            }
        }
        return ProductStock::where('variant', $str)->first();
    }

    public function varient_price(Request $request) {
        $product = Product::with('stock')->find($request->product_id);

        $str = '';
        foreach ($product->attributes as $key => $item) {
            if($str != null){
                $str .= '-'.str_replace(' ', '', $request['variation_'.$key]);
            }
            else{
                $str .= str_replace(' ', '', $request['variation_'.$key]);
            }
        }
        return ProductStock::where('variant', $str)->first();
    }
}
