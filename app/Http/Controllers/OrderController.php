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

    public function update(Request $request)
    {
        // TODO
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
