<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    
    public function index()
    {
        $data = Order::paginate(10);
        return view('backend.orders.index')->with('data',$data);
    }


}
