<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\Product;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class AttributeController extends Controller
{
    public function index() {
        $product = Product::with(['property'])->get();
        return $product;
        // Toastr::success('Messages in here', 'Title', ["positionClass" => "toast-top-center"]);
        // return view('attribute', compact('product'));
    }

    public function store(Request $request) {
        // $request->validate([
        //     'name' => 'required|unique:attributes,name',
        //     'values' => 'array',
        // ]);
    
        // dd($request->values);
        // Attribute::create([
        //     'name' => $request->name,
        //     'values' => $request->values
        // ]);

        return back()->with('success', 'Attribute create successfully');
    }
}
