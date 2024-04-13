<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;


class OrdersDashboardController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with(['user','products','addresses'])->paginate();

        return view('Dashboard.orders.index' ,['orders'=>$orders]);
    }

}
