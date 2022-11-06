<?php

namespace App\Http\Controllers;

use App\Models\Insight;
use App\Models\Order;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return inertia('Dashboard', [
            'visit_today' => Insight::whereDate('created_at', now())->count(),
            'visit_month' => Insight::whereMonth('created_at', now())->count(),
            'order_total' => Order::count(),
            'order_paid' => Order::where('order_status', Order::STATUS_PAID)->count()
        ]);
    }
}
