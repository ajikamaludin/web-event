<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Setting;
use App\Services\MidtransService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{
    public function home()
    {
        return view('welcome');
    }

    public function order()
    {
        $setting = Setting::first();
        $orderNumber = time() + rand(1000, 9999);

        $amount = number_format($setting->ticket_price, 0, ',', '.');

        return view('order', [
            'ordernum' => $orderNumber,
            'setting' => $setting,
            'amount' => $amount,
        ]);
    }

    public function pay(Request $request)
    {
        $request->validate([
            'ordernum' => 'required|numeric',
            'phone_number' => 'required|numeric',
            'name' => 'required|string',
            'address' => 'required|string',
            'email' => 'required|required',
        ]);
        
        $setting = Setting::first();

        DB::beginTransaction();
        $order = Order::make([
            'order_id' => $request->ordernum,
            'order_date' => now(),
            'order_amount' => $setting->ticket_price,
            'order_status' => Order::STATUS_NOT_PAID,
            'name' => $request->name,
            'address'=> $request->address,
            'email'=> $request->email,
            'phone_number'=> $request->phone_number,
        ]);

        $snap_url = $setting->is_production == 1 ? $setting->midtrans_snap_prod : $setting->midtrans_snap_dev;
        $token = (new MidtransService($order, $setting->midtrans_server_key, $setting->is_production == 1))->getSnapToken();
        $order->order_token = $token;
        $order->save();
        DB::commit();

        return view('pay', [
            'order' => $order,
            'setting' => $setting,
            'token' => $token,
            'snap_url' => $snap_url,
        ]);
    }


    public function show(Order $order)
    {
        $setting = Setting::first();
        $snap_url = $setting->is_production == 1 ? $setting->midtrans_snap_prod : $setting->midtrans_snap_dev;

        return view('pay', [
            'order' => $order,
            'setting' => $setting,
            'token' => $order->order_token,
            'snap_url' => $snap_url,
        ]);
    }

    public function callback(Request $request)
    {
        $order = Order::where('order_id', $request->order_id)->firstOrFail();

        if ($request->transaction_status == 'settlement' || $request->transaction_status == 'capture') {
            $order->update([
                'order_payment' => $request->transaction_time,
                'order_payment_channel' => 'Midtrans|'.$request->payment_type,
                'order_status' => Order::STATUS_PAID,
                'midtrans_detail_callback' => json_encode($request->all())
            ]);
        } else if($request->transaction_status == 'pending' ) {
            $order->update([
                'order_payment' => $request->transaction_time,
                'order_payment_channel' => 'Midtrans|'.$request->payment_type,
                'order_status' => Order::STATUS_PENDING,
                'midtrans_detail_callback' => json_encode($request->all())
            ]);
        } else {
            $order->update([
                'order_payment' => $request->transaction_time,
                'order_payment_channel' => 'Midtrans|FAIL',
                'order_status' => Order::STATUS_FAIL,
                'midtrans_detail_callback' => json_encode($request->all())
            ]);
        }

        return response()->json([
            'status' => 'ok!',
            'order' => $order,
        ]);
    }

    public function finish(Request $request)
    {
        $order = Order::where('order_id', $request->order_id)->firstOrFail();

        if ($request->transaction_status == 'settlement' || $request->transaction_status == 'capture') {
            $order->update([
                'order_payment' => $request->transaction_time,
                'order_payment_channel' => 'Midtrans|'.$request->payment_type,
                'order_status' => Order::STATUS_PAID,
                'midtrans_detail_callback' => json_encode($request->all())
            ]);
        } else if($request->transaction_status == 'pending' ) {
            $order->update([
                'order_payment' => $request->transaction_time,
                'order_payment_channel' => 'Midtrans|'.$request->payment_type,
                'order_status' => Order::STATUS_PENDING,
                'midtrans_detail_callback' => json_encode($request->all())
            ]);
        } else {
            $order->update([
                'order_payment' => $request->transaction_time,
                'order_payment_channel' => 'Midtrans|FAIL',
                'order_status' => Order::STATUS_FAIL,
                'midtrans_detail_callback' => json_encode($request->all())
            ]);
        }

        return redirect()->route('order.show', $order);
    }
}
