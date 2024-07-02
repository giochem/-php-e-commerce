<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Category, Product, Cart, ShippingInfo, Order};

class OrderController extends Controller
{
  public function index()
  {
    $pending_orders = Order::where(['status' => 'pending'])->latest()->get();
    return view('admin.pendingorder', compact('pending_orders'));
  }
  public function getApproveOrder()
  {
    $approve_orders = Order::where(['status' => 'approve'])->latest()->get();
    return view('admin.approveorder', compact('approve_orders'));
  }
  public function getRejectOrder()
  {
    $reject_orders = Order::where(['status' => 'reject'])->latest()->get();
    return view('admin.rejectorder', compact('reject_orders'));
  }
  public function approveOrder($id)
  {
    Order::findOrFail($id)->update([
      'status' => "approve"
    ]);

    $pending_orders = Order::where(['status' => 'pending'])->latest()->get();
    return view('admin.pendingorder', compact('pending_orders'));
  }
  public function rejectOrder($id)
  {
    Order::findOrFail($id)->update([
      'status' => "reject"
    ]);

    $pending_orders = Order::where(['status' => 'pending'])->latest()->get();
    return view('admin.pendingorder', compact('pending_orders'));
  }
}
