<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\TopupBalance;
use App\Transaction;

class BalanceController extends Controller
{
    public function index()
    {
        return view('member_area.topup_balance.index');
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'mobile_number' => 'required|min:7|max:12|regex:/(081)/',
            'value' => 'required',
        ]);

        $n = $request->value * 0.05;
        $value = $request->value + $n;
        $input = [
            'mobile_number' => $request->mobile_number,
            'value' => $value,
        ];

        $last_id = TopupBalance::create($input)->id;

        $input2 = [
            'user_id' => auth()->user()->id,
            'topup_balance_id' => $last_id,
            'status' => 0,
        ];

        $last_id2 = Transaction::create($input2)->id;

        return redirect()->route('success', $last_id2)->with('action', 'Your mobile phone number '.$request->mobile_number.' will receive Rp. '.$value.'');
    }
}  
