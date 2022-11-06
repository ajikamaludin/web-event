<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\Order;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::orderBy('updated_at', 'desc');

        if ($request->q != "") {
            $query->where('order_id', 'like', '%'.$request->q.'%')
                ->orWhere('name', 'like', '%'.$request->q.'%')
                ->orWhere('phone_number', 'like', '%'.$request->q.'%');
        }

        if ($request->is_checked != "") {
            $query->where('is_checked', $request->is_checked);
        }

        if ($request->order_status != "") {
            $query->where('order_status', $request->order_status);
        }

        return inertia('Order/Index', [
            'orders' => $query->paginate(10)
        ]);
    }

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'order_status' => 'required|in:0,1,2',
            'name' => 'required|string',
            'address' => 'required|string',
            'email' => 'required|email',
            'phone_number' => 'required|numeric',
            'is_checked' => 'required|bool',
        ]);

        $order->fill([
            'name' => $request->name,
            'address' => $request->address,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'is_checked' => $request->is_checked ? 1 : 0,
        ]);

        if ($request->order_status != $order->order_status && $request->order_status == Order::STATUS_PAID) {
            $order->order_payment_channel = Order::CHANNEL_MANUAL;
        }

        $order->order_status = $request->order_status;
        $order->save();
        
        return redirect()->route('orders.index')
                    ->with('message', ['type' => 'success', 'message' => 'The data has beed saved']);
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('orders.index');
    }

    public function export(Request $request)
    {
        $query = Order::orderBy('updated_at', 'desc');

        if ($request->q != "") {
            $query->where('order_id', 'like', '%'.$request->q.'%')
                ->orWhere('name', 'like', '%'.$request->q.'%')
                ->orWhere('phone_number', 'like', '%'.$request->q.'%');
        }

        if ($request->is_checked != "") {
            $query->where('is_checked', $request->is_checked);
        }

        if ($request->order_status != "") {
            $query->where('order_status', $request->order_status);
        }

        return (new FastExcel($query->get()))->download("orders-ticket-".now()->format('d-m-Y').".xlsx");
    }

    public function check(Request $request)
    {
        $orderId =  Str::replace('A', '', $request->order_id);
        $order = Order::where('order_id', $orderId)->first();

        if ($order == null) {
            return response()->json(["message" => "order not found"], 404);
        }

        if ($order->is_checked == 1) {
            return response()->json(["message" => "tiket sudah ditukarkan"], 422);
        }

        $order->update(['is_checked' => 1]);

        return response()->json(["message"=>"Ok!"]);
    }
}
