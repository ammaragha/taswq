<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Traits\CartsTrait;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class OrdersController extends Controller
{
    use CartsTrait;

    public function index()
    {
        $data = Order::where('status','!=','refunded')->OrderBy('status','ASC')->paginate(5);
        return view('backend.orders.index')->with('data', $data);
    }


    public function ship($id)
    {
        try {
            Order::find($id)->update([
                'status' => 'shipped'
            ]);
            Session::flash('k', 'Shipped :)');
        } catch (\Exception $th) {
            Session::flash('err', 'Something wonrg!');
        }
        return Redirect::back();
    }

    public function deliver($id)
    {
        try {
            Order::find($id)->update([
                'status' => 'delivered'
            ]);
            Session::flash('k', 'delivered :)');
        } catch (\Exception $th) {
            Session::flash('err', 'Something wonrg!');
        }
        return Redirect::back();
    }

    public function refund($id)
    {
        try {
            $order = Order::find($id);
            $order->update([
                'status' => 'refunded'
            ]);
            $this->refundCart($order->cart->id);
            Session::flash('k', 'refunded :)');
        } catch (\Exception $th) {
            Session::flash('err', 'Something wonrg!');
        }
        return Redirect::back();
    }
}
