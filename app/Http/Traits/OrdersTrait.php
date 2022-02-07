<?php

namespace App\Http\Traits;

use App\Cart;

trait OrdersTrait
{


    
    /**
     * full details about price cart details
     * @param id $cart_id
     * @return array
     */
    public function priceDetails($cart_id)
    {
        $cart = Cart::find($cart_id);
        $ress = [];
        foreach ($cart->products as $product) {
            $discount = $product->discount;
            $price = $product->price;
            $quantity = $product->item->quantity;
            $afterDiscount = $quantity * $this->countDiscount($discount, $price);
            array_push($ress, [
                'quantity'=> $quantity,
                'discount' => $discount,
                'price' => $price,
                'afterDiscount' => $afterDiscount
            ]);
        }

        return $ress;
    }


    /**
     * totla price of cart
     * @param id $cart_id
     * @return double $total
     */
    public function totalPrice($cart_id)
    {
        $priceDetails = $this->priceDetails($cart_id);
        $total = 0;
        //dd($priceDetails);
        foreach($priceDetails as $detail){
            $total = $total + $detail['afterDiscount'];
        }
        return $total;
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
