<?php

namespace App\Http\Traits;

use App\Cart;
use App\CartProduct;
use App\Http\Traits\Api\ResponseTrait;
use App\Product;
use Auth;
use Illuminate\Http\Request;

trait CartsTrait
{
    use ResponseTrait;
    /**
     * Get Open cart
     * @param id $user_id
     * @return App\Cart
     */
    public function getOpenCart()
    {
        $id = Auth::user()->id;
        $cart = Cart::where('user_id', $id)->where('status', 1)->latest()->first();
        if (!$cart)
            return false;
        return $cart;
    }

    /**
     * Check if Product into Cart
     * @param id $cart_id
     * @param id $pro_id
     * @return App\CartProduct
     */
    public function proInCart($cart_id, $pro_id)
    {
        return CartProduct::where('cart_id', $cart_id)->where('pro_id', $pro_id); //check 
    }


    /**
     * Add new Product to Cart
     * @param App\Cart $cart
     * @param App\Product $product
     * @param Illuminate\Http\Request
     */
    public function newPro($cart, $product, Request $request)
    {
        return CartProduct::create([
            'pro_id' => $product->id,
            'cart_id' => $cart->id,
            'quantity' => $request->quantity,
        ]);
    }

    /**
     * modify Quantity and price of Product into Cart
     * @param App\Cart $cart
     * @param App\Product $product
     * @param Illuminate\Http\Request
     */
    public function modifyPro($cart, $product, Request $request)
    {
        $reset = $request->reset ? 0 : 1; //reset 
        $proInCart = $this->proInCart($cart->id, $product->id);
        $newQ = ($reset * $proInCart->first()->quantity) +  $request->quantity; // if reset will add new Quantity if not will add new Q
        $proInCart->update([
            'quantity' => $newQ,
        ]);

        return $proInCart;
    }

   


    /**
     * make sure about quantities between carts and products
     * @param id $cart_id
     * @return App\Http\Trait\ResponseTrait || array
     */
    public function checkQCart($cart_id)
    {
        $cart = Cart::find($cart_id);
        $news = [];
        foreach ($cart->products as $product) {
            $cartQ = $product->item->quantity; //Quatity on cart
            $productQ = $product->quantities; //product quantity on store
            $newQ = $productQ - $cartQ; //new  quantity

            if ($newQ < 0){
                array_push($news,['msg'=> $product->name . "have no Quantity on store"]);
                return ['status'=>false, 'news'=>$news];
            }

            array_push($news, ['id' => $product->id, 'quantities' => $newQ]);
        }
        return true;
    }





   
}
