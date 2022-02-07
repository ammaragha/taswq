<?php

namespace App\Http\Controllers\Api;

use App\Cart;
use App\CartProduct;
use App\Http\Controllers\Controller;
use App\Http\Traits\Api\ResponseTrait;
use App\Http\Traits\CartsTrait;
use App\Http\Traits\OrdersTrait;
use App\Order;
use Illuminate\Http\Request;
use Auth;

class OrderController extends Controller
{

    use ResponseTrait, CartsTrait,OrdersTrait;

    public function order()
    {

        $cart_id = $this->getOpenCart();

        if (!$cart_id) //if no Carts on hold
            return $this->errMsg('no cart');

        $cart_id = $cart_id->id;

        $cartProducts = CartProduct::where('cart_id', $cart_id); //hold all cart products

        if (!$cartProducts->first()) //if no products
            return $this->errMsg('Cart Empty idiot');

        //some info
        $address_id = Auth::user()->addresses->where('usability', 1)->first()->id;
        if (!$address_id)
            return $this->errMsg('No address to send to it');

        
        $total_price = $this->totalPrice($cart_id); //sum of all products price
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
            Cart::find($cart_id)->update([
                'status' => 0,
            ]);
            return $this->succWithData($data, 'Order saved');
        } catch (\Exception $th) {
            return $this->errMsg($th->getMessage());
        }
    }
}
