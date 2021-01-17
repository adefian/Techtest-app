<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Product;
use App\Transaction;

class ProductController extends Controller
{
    public function index()
    {
        return view('member_area.product.index');
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'product' => 'required|min:10|max:150',
            'address' => 'required|min:10|max:150',
            'price' => 'required',
        ]);

        $price = $request->price + 1000;
        $random = Str::random(8);

        $input = [
            'product' => $request->product,
            'shipping_address' => $request->address,
            'price' => $price,
            'code' =>   $random,
        ];

        $last_id = Product::create($input)->id;


        $input2 = [
            'user_id' => auth()->user()->id,
            'product_id' => $last_id,
            'status' => 0,
        ];

        $last_id2 = Transaction::create($input2)->id;

        return redirect()->route('success', $last_id2)->with('action', $request->product.' that costs '.$price.' will be shipped to :'.$request->address.' only after you pay');;
    }
}
