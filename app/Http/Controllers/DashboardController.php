<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItems;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index(){
        $products = Product::all()->count();
        $orders = Order::all()->count();
        $activeProducts = Product::all()->where('active', '=',true)->count();
        $draftProducts = Product::all()->where('active', '=',false)->count();
        $ordersItems = OrderItems::all()->count();

        $dashboardResults['products'] = $products;
        $dashboardResults['orders'] = $orders;
        $dashboardResults['order-items'] = $ordersItems;
        $dashboardResults['active-products'] = $activeProducts;
        $dashboardResults['draft-products'] = $draftProducts;

        return view('admin.dashboard', compact('dashboardResults'));
    }
}
