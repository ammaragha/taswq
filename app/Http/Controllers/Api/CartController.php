<?php

namespace App\Http\Controllers\Api;

use App\Cart;
use App\Http\Controllers\Controller;
use App\Http\Traits\Api\ResponseTrait;
use Illuminate\Http\Request;
use Auth;
class CartController extends Controller
{
    
    use ResponseTrait;
    /**
     * create a new cart for user
     * @return response
     */
    public function create(Request $request)
    {
        $id = Auth::user()->id;
        try {
            $old = Cart::where('user_id',$id)->latest()->first();
            if($old && $old->status == 0){
                Cart::create([
                    'user_id'=>$id,
                ]);
                return $this->succMsg('nicew!');
            }
            return $this->errMsg('he have cart already on hold');
        } catch (\Exception $th) {
            return $this->errMsg('nope');
        }
    }
}
