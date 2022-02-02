<?php

namespace App\Http\Controllers\Api;

use App\Cart;
use App\CartProduct;
use App\Http\Controllers\Controller;
use App\Http\Traits\Api\MapResponseTrait;
use App\Http\Traits\Api\ResponseTrait;
use App\Http\Traits\PaginationTrait;
use App\Product;
use Illuminate\Http\Request;
use Auth;

class CartController extends Controller
{

    use ResponseTrait, MapResponseTrait, PaginationTrait;


    /**
     * create a new cart for user
     * @return response
     */
    public function create(Request $request)
    {
        $id = Auth::user()->id;
        try {
            $cart = Cart::where('user_id', $id)->latest()->first();
            if ($cart && $cart->status == 0) {
                $cart = Cart::create([
                    'user_id' => $id,
                ]);
            }
            $data = ['cart_id' => $cart->id];
            return $this->succWithData($data, 'cart on hold');
        } catch (\Exception $th) {
            return $this->errMsg('nope');
        }
    }

    public function add(Request $request, $id)
    {
        $cart = Cart::find($id);
        $product = Product::find($request->proId);
        if ($cart && $product) {
            CartProduct::create([
                'pro_id' => $product->id,
                'cart_id' => $cart->id,
                'quantity' => $request->quantity,
                'total_price' => $request->quantity * $product->price
            ]);

            return $this->succMsg('Done');
        }
        return $this->errMsg('Something wrong with your request');
    }

    public function view($id)
    {
        $cart = Cart::find($id);
        $ress = [];
        if ($cart && $cart->status == 1) {
            foreach ($cart->products as $product) {
                $item = $product->item;
                $product = Product::where('id', $item->pro_id)->with('images')->get();
                $product = $this->mapProducts($product);
                array_push($ress, [
                    'product' => $product,
                    'quantity' => $item->quantity,
                    'price' => $item->total_price
                ]);
            }
            $ress = $this->paginate($ress,5);
            return $this->succWithData($ress);
        }
        return $this->errMsg('This cart unavilable');
    }


    public function remove(Request $request,$id)
    {
        $pro_id = $request->proId;
        $cartProdut = CartProduct::where('cart_id',$id)->where('pro_id',$pro_id);
        if($cartProdut->first()){
            $cartProdut->delete();
            return $this->succMsg('removed');
        }
        return $this->errMsg('maybe product not exist or cart');
    }
}
