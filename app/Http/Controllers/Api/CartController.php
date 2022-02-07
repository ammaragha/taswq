<?php

namespace App\Http\Controllers\Api;

use App\Cart;
use App\CartProduct;
use App\Http\Controllers\Controller;
use App\Http\Traits\Api\MapResponseTrait;
use App\Http\Traits\Api\ResponseTrait;
use App\Http\Traits\CartsTrait;
use App\Http\Traits\PaginationTrait;
use App\Product;
use Illuminate\Http\Request;
use Auth;

class CartController extends Controller
{

    use ResponseTrait, MapResponseTrait, PaginationTrait,CartsTrait;


    /**
     * create a new cart for user
     * @return response
     */
    public function create(Request $request)
    {
        $id = Auth::user()->id;
        try {
            $cart = $this->getOpenCart(); // get last cart for user
            if (!$cart) { // check if cart on hold or already complated 
                $cart = Cart::create([
                    'user_id' => $id,
                ]);
            }
            $data = ['cart_id' => $cart->id]; //return  useable cart
            return $this->succWithData($data, 'cart on hold');
        } catch (\Exception $th) {
            return $this->errMsg($th->getMessage());
        }
    }

    public function add(Request $request)
    {
        $pro_id = $request->proId;
        $cart = $this->getOpenCart();
        $product = Product::find($pro_id); // back to here again need to check availability
        if ($cart && $product && $product->availability == 1) {

            $proInCart = $this->proInCart($cart->id, $pro_id);
            if ($proInCart->first())
                $this->modifyPro($cart, $product, $request);
            else
                $this->newPro($cart, $product, $request);


            return $this->succMsg('Done');
        }
        return $this->errMsg('Something wrong with your request or Product not available');
    }

    public function view()
    {
        $cart = $this->getOpenCart();
        $ress = []; //result 
        if ($cart) { // check the cart 
            foreach ($cart->products as $product) { //loop into all products
                $item = $product->item; // pivot
                $product = Product::where('id', $item->pro_id)->with('images')->get(); //bring products
                $product = $this->mapProducts($product); //mapping them
                array_push($ress, [ // push them to result
                    'product' => $product,
                    'quantity' => $item->quantity,
                ]);
            }
            $ress = $this->paginate($ress, 5); //paginating them
            return $this->succWithData($ress);
        }
        return $this->errMsg('This cart unavilable');
    }


    public function remove(Request $request)
    {
        $cart = $this->getOpenCart();
        $pro_id = $request->proId;
        $cartProdut = $this->proInCart($cart->id, $pro_id);
        if ($cartProdut->first()) {
            $cartProdut->delete();
            return $this->succMsg('removed');
        }
        return $this->errMsg('maybe product not exist or cart');
    }





   
}
