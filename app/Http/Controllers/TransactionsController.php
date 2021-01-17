<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transaction;
use App\Product;
use App\TopupBalance;
use Carbon\Carbon;

class TransactionsController extends Controller
{
    public function success($id)
    {
        $order = Transaction::findOrFail($id);

        if($order->product_id){
            $product_id = Product::findOrFail($order->product_id);
            $total = $product_id->price;
        } else {
            $balance_id = TopupBalance::findOrFail($order->topup_balance_id);
            $total = $balance_id->value;
        }

        return view('member_area.success', compact('order', 'total', 'balance_id', 'product_id'));
    }

    public function payment()
{
        return view('member_area.payment');
    }

    public function payment_pay(Request $request)
    {
        $validated = $request->validate([
            'order' => 'required',
        ]);

        $pay = Transaction::where('id', $request->order)->where('status', 0)->first();

        if ($pay) {
            
            if($pay->product_id)
                $data = [
                    'status' => 4,
                ];
            else{
                $data = [
                    'status' => 1,
                ];
            }

            $pay->update($data);

            return redirect()->route('order');
        } else {
            return back()->with('action', 'This Order Not Found');
        }

    }

    public function order()
    {
        setlocale(LC_TIME, 'nl_NL.utf8');
        Carbon::setLocale('id');

        $tgl = Carbon::now();
        $hminute = $tgl->subMinutes(5);
        $data = Transaction::where('user_id', auth()->user()->id)->orderBy('updated_at', 'DESC')->paginate(20);
        
        //for update data over 5 minutes 
        $updated_5 = Transaction::where('status', 0)->where('updated_at', '<', $hminute)->first();
// dd($updated_5);
        if($updated_5){
            $updated_5->update([
                'status' => 3
            ]);
        }

        return view('member_area.order-history', compact('data'));
    }
}
