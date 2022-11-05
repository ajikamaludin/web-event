<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return inertia('Dashboard', [
            'visit_today' => 0,
            'visit_month' => 0,
            'order_total' => Order::count(),
            'order_paid' => Order::where('order_status', Order::STATUS_PAID)->count()
        ]);
    }
}
