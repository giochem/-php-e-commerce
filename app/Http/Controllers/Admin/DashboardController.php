<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view("admin.dashboard");
    }
    public function barChartData(Request $request)
    {
        dd($request);
        $orders = Order::where("product_id", $request->product_id)
            ->when($request->from, function ($query) use ($request) {
                return $query->whereDate('updated_at', '>=', $request->from);
            })
            ->when($request->from, function ($query) use ($request) {
                return $query->whereDate('updated_at', '<=', $request->to);
            })
            ->groupBy('status')
            ->selectRaw('SUM(quantity) as quantity, status')->get();
        return response()->json(['orders' => $orders]);
    }
}
