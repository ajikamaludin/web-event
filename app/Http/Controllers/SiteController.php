<?php

namespace App\Http\Controllers;

use App\Mail\OrderCreated;
use App\Mail\OrderPayed;
use App\Models\Order;
use App\Models\Setting;
use App\Models\Ticket;
use App\Services\MidtransService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SiteController extends Controller
{
    public function home()
    {
        return view('welcome');
    }

    public function order()
    {
        $tickets = Ticket::all();
        $setting = Setting::first();
        $orderNumber = time() + rand(1000, 9999);

        return view('order', [
            'ordernum' => $orderNumber,
            'setting' => $setting,
            'tickets' => $tickets,
        ]);
    }

    public function pay(Request $request)
    {
        $request->validate([
            'ordernum' => 'required|numeric',
            'phone_number' => 'required|numeric',
            'name' => 'required|string',
            'address' => 'required|string',
            'email' => 'required|email',
            'ticket_id' => 'required|exists:tickets,id',
            'count' => 'required|numeric'
        ]);
        
        $setting = Setting::first();
        $ticket = Ticket::find($request->ticket_id);
        $amount = $ticket->price * $request->count;

        DB::beginTransaction();
        $order = Order::make([
            'order_id' => $request->ordernum,
            'order_date' => now(),
            'order_amount' => $amount,
            'order_status' => Order::STATUS_NOT_PAID,
            'name' => $request->name,
            'address'=> $request->address,
            'email'=> $request->email,
            'phone_number'=> $request->phone_number,
            'ticket_id' => $ticket->id,
            'ticket_price' => $ticket->price,
            'ticket_count' => $request->count,
        ]);

        $snap_url = $setting->is_production == 1 ? $setting->midtrans_snap_prod : $setting->midtrans_snap_dev;
        $token = (new MidtransService($order, $setting->midtrans_server_key, $setting->is_production == 1))->getSnapToken();
        $order->order_token = $token;
        $order->save();
        DB::commit();
        Mail::to($request->email)->send(new OrderCreated($order));

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

        if ($order->order_status == Order::STATUS_PAID) {
            return response()->json([
                'status' => 'ok!',
                'order' => $order,
            ]);
        }
        if ($request->transaction_status == 'settlement' || $request->transaction_status == 'capture') {
            $order->update([
                'order_payment' => $request->transaction_time,
                'order_payment_channel' => 'Midtrans|'.$request->payment_type,
                'order_status' => Order::STATUS_PAID,
                'midtrans_detail_callback' => json_encode($request->all())
            ]);
            Mail::to($order->email)->send(new OrderPayed($order));
        } elseif ($request->transaction_status == 'pending') {
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

        if ($order->order_status == Order::STATUS_PAID) {
            return redirect()->route('order.show', $order);
        }
        if ($request->transaction_status == 'settlement' || $request->transaction_status == 'capture') {
            $order->update([
                'order_payment' => now(),
                'order_payment_channel' => 'Midtrans|'.$request->payment_type,
                'order_status' => Order::STATUS_PAID,
                'midtrans_detail_callback' => json_encode($request->all())
            ]);
            Mail::to($order->email)->send(new OrderPayed($order));
        } elseif ($request->transaction_status == 'pending') {
            $order->update([
                'order_payment' => now(),
                'order_payment_channel' => 'Midtrans|'.$request->payment_type,
                'order_status' => Order::STATUS_PENDING,
                'midtrans_detail_callback' => json_encode($request->all())
            ]);
        } else {
            $order->update([
                'order_payment' => now(),
                'order_payment_channel' => 'Midtrans|FAIL',
                'order_status' => Order::STATUS_FAIL,
                'midtrans_detail_callback' => json_encode($request->all())
            ]);
        }

        return redirect()->route('order.show', $order);
    }
}
