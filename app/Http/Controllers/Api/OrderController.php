<?php

namespace App\Http\Controllers\Api;

use App\Cart;
use App\CartProduct;
use App\Http\Controllers\Controller;
use App\Http\Traits\Api\ResponseTrait;
use App\Http\Traits\CartsTrait;
use App\Order;
use App\UserOrder;
use Illuminate\Http\Request;
use Auth;

class OrderController extends Controller
{

    use ResponseTrait, CartsTrait;

    public function order()
    {

        $cart_id = $this->getOpenCart()->id;
        $address_id = Auth::user()->addresses->where('usability', 1)->first()->id;
        $cartProducts = CartProduct::where('cart_id', $cart_id)->first();
        if (!$cartProducts)
            return $this->errMsg('Cart Empty idiot');
        $total_price = $cartProducts->sum('total_price');
        $start = '2022-02-03';
        $arival = '2022-02-03';

        try {
            $data = Order::create([
                'start' => $start,
                'arrival' => $arival,
                'status' => 'out',
                'total_price' => $total_price,
                'address_id' => $address_id,
                'cart_id' => $cart_id
            ]);
            UserOrder::create([
                'user_id' => Auth::user()->id,
                'order_id' => $data->id
            ]);
            Cart::find($cart_id)->update([
                'status' => 0,
            ]);
            return $this->succWithData($data, 'Order saved');
        } catch (\Exception $th) {
            return $this->errMsg($th->getMessage());
        }
    }
}
