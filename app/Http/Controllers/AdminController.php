<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class AdminController extends Controller
{
    public function dashboard () {

        return view('admin.dashboard');
    }

    public function commandes(){

        $orders = Order::get();

        $orders->transform(function($order, $key){
            $order->panier = unserialize($order->panier);
            return $order;
        });

        return view('admin.commandes')->with('orders', $orders);
    }
}
