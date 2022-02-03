<?php

namespace App\Http\Traits;

use App\Cart;
use App\CartProduct;
use Auth;
use Illuminate\Http\Request;

trait CartsTrait
{
    /**
     * Get Open cart
     * @param id $user_id
     * @return App\Cart
     */
    public function getOpenCart()
    {
        $id = Auth::user()->id;
        return Cart::where('user_id', $id)->where('status',1)->latest()->first();
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
            'total_price' => $request->quantity * $this->countDiscount($product->discount, $product->price),
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
            'total_price' => $newQ * $this->countDiscount($product->discount, $product->price)
        ]);

        return $proInCart;
    }

    /**
     * to count the discount on item
     * @param double $discount
     * @param double $prive
     * @return double discounted price
     */
    public function countDiscount($discount, $price) // count the discount 
    {
        return $price * (1 - ($discount / 100));
    }
}
