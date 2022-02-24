<?php

namespace App\Http\Traits;

use App\Cart;
use App\Product;

trait OrdersTrait
{



    /**
     * full details about price cart details
     * @param id $cart_id
     * @return array
     */
    public function priceDetails($cart_id, $checkOut = false) //badest functioni have :()
    {
        $cart = Cart::find($cart_id);
        $ress = [];
        $notValid = [];
        foreach ($cart->products as $product) {
            $discount = $product->discount;
            $price = $product->price;
            $quantity = $product->item->quantity;
            $validProduct = $this->checkQuantity($product->id, $quantity);
            if (!$validProduct) {
                array_push($notValid, [
                    'id' => $product->id,
                    'name' => $product->name,
                    'valid_quantity' => $product->quantities
                ]);
            } else {
                $afterDiscount = $quantity * $this->countDiscount($discount, $price);
                array_push($ress, [
                    'quantity' => $quantity,
                    'discount' => $discount,
                    'price' => $price,
                    'afterDiscount' => $afterDiscount
                ]);
                if ($checkOut) {
                    $afterCheckOut = ($product->quantities - $quantity);
                    $product->update([
                        'quantities' => $afterCheckOut //reduce quantity after checkout

                    ]);
                }
            }
        }

        if (empty($notValid)) {
            $ress['status'] = true;
        } else {
            $ress = $notValid;
            $ress['status'] = false;
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
        $priceDetails = $this->priceDetails($cart_id, true);
        $total = 0;
        array_pop($priceDetails);
        //dd($priceDetails);
        $total = array_reduce($priceDetails, function ($acc, $val) {
            return $acc + $val['afterDiscount'];
        }, 0);
        return $total;
    }


    /**
     * Check if ordered quantity less or equal product quantity
     * @param id $product_id
     * @param int $cartQuantity
     * @return boolean 
     */
    public function checkQuantity($pro_id, $cartQuantity)
    {
        $proQuantity = Product::find($pro_id)->quantities;
        return $proQuantity >= $cartQuantity;
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
