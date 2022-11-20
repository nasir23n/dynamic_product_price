<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        $products = Product::where('varient', 1)->with('stock')->get();

        return view('welcome', compact('products'));
    }

    public function varient_price(Request $request) {
        $product = Product::with('stock')->find($request->pid);
        return $product;
        // $str = '';
        // $quantity = 0;
        // $tax = 0;
        // $max_limit = 0;

        // if($request->has('color')){
        //     $str = $request['color'];
        // }

        // if(json_decode($product->choice_options) != null){
        //     foreach (json_decode($product->choice_options) as $key => $choice) {
        //         if($str != null){
        //             $str .= '-'.str_replace(' ', '', $request['attribute_id_'.$choice->attribute_id]);
        //         }
        //         else{
        //             $str .= str_replace(' ', '', $request['attribute_id_'.$choice->attribute_id]);
        //         }
        //     }
        // }

        // $product_stock = $product->stocks->where('variant', $str)->first();
        // $price = $product_stock->price;

        // if($product->wholesale_product){
        //     $wholesalePrice = $product_stock->wholesalePrices->where('min_qty', '<=', $request->quantity)->where('max_qty', '>=', $request->quantity)->first();
        //     if($wholesalePrice){
        //         $price = $wholesalePrice->price;
        //     }
        // }

        // $quantity = $product_stock->qty;
        // $max_limit = $product_stock->qty;

        // if($quantity >= 1 && $product->min_qty <= $quantity){
        //     $in_stock = 1;
        // }else{
        //     $in_stock = 0;
        // }

        // //Product Stock Visibility
        // if($product->stock_visibility_state == 'text') {
        //     if($quantity >= 1 && $product->min_qty < $quantity){
        //         $quantity = translate('In Stock');
        //     }else{
        //         $quantity = translate('Out Of Stock');
        //     }
        // }

        // //discount calculation
        // $discount_applicable = false;

        // if ($product->discount_start_date == null) {
        //     $discount_applicable = true;
        // }
        // elseif (strtotime(date('d-m-Y H:i:s')) >= $product->discount_start_date &&
        //     strtotime(date('d-m-Y H:i:s')) <= $product->discount_end_date) {
        //     $discount_applicable = true;
        // }

        // if ($discount_applicable) {
        //     if($product->discount_type == 'percent'){
        //         $price -= ($price*$product->discount)/100;
        //     }
        //     elseif($product->discount_type == 'amount'){
        //         $price -= $product->discount;
        //     }
        // }

        // // taxes
        // foreach ($product->taxes as $product_tax) {
        //     if($product_tax->tax_type == 'percent'){
        //         $tax += ($price * $product_tax->tax) / 100;
        //     }
        //     elseif($product_tax->tax_type == 'amount'){
        //         $tax += $product_tax->tax;
        //     }
        // }

        // $price += $tax;

        // return array(
        //     'price' => single_price($price*$request->quantity),
        //     'quantity' => $quantity,
        //     'digital' => $product->digital,
        //     'variation' => $str,
        //     'max_limit' => $max_limit,
        //     'in_stock' => $in_stock
        // );
    }
}
