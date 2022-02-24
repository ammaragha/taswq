<?php

namespace App\Http\Controllers\Api;

use App\CartProduct;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\OrderRequest;
use App\Http\Traits\Api\MapResponseTrait;
use App\Http\Traits\Api\ResponseTrait;
use App\Http\Traits\CartsTrait;
use App\Http\Traits\OrdersTrait;
use App\Order;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;

class OrderController extends Controller
{

    use ResponseTrait, MapResponseTrait, CartsTrait, OrdersTrait;

    /**
     * Order NOW :D
     */
    public function order()
    {

        $cart = $this->getOpenCart(); // get cart

        if (!$cart) //if no Carts on hold
            return $this->errMsg('no cart');


        $cartProducts = CartProduct::where('cart_id', $cart->id); //hold all cart products

        if (!$cartProducts->first()) //if no products
            return $this->errMsg('Cart Empty idiot');

        //some info
        $address_id = Auth::user()->addresses->where('usability', 1)->first()->id; //get active address
        if (!$address_id)
            return $this->errMsg('No address to send to it');


        if (!$this->priceDetails($cart->id)['status']) //check quantity
            return $this->errWithData($this->priceDetails($cart->id), 'Not Valid quantity of products');


        try {

            $total_price = $this->totalPrice($cart->id); //sum of all products price

            $order = Order::create([
                'start' => Carbon::now(),
                'arrival' => Carbon::now()->addDays(3),
                'status' => 'ordered',
                'total_price' => $total_price,
                'address_id' => $address_id,
                'cart_id' => $cart->id
            ]);
            $cart->update([ //close cart
                'status' => 0,
            ]);


            $data = $this->mapOrder($order); //maping
            return $this->succWithData($data, 'Order saved');
        } catch (\Exception $th) {
            return $this->errMsg($th->getMessage());
        }
    }

    /**
     * Show Order details
     * @param Request\OrderRequest $requset
     * @return response
     */
    public function show(OrderRequest $request)
    {
        $order = Order::find($request->order_id);
        $data = $this->mapOrder($order);
        return $this->succWithData($data);
    }

    /**
     * Show Orders History
     * @return response
     */
    public function all()
    {
        try {
            $carts = Auth::user()->carts; // user carts

            $orders = [];
            foreach ($carts as $cart) //orders which cart belongs to
                array_push($orders, $cart->order);


            $data = array_map(function ($var) { //mapping
                if ($var)
                    return $this->mapOrder($var);
            }, $orders);
            return $this->succWithData($data);
        } catch (\Exception $e) {
            return $this->errMsg($e->getMessage());
        }
    }
}
