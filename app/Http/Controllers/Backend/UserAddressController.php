<?php

namespace App\Http\Controllers\Backend;

use App\Address;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UsersAddressRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class UserAddressController extends Controller
{
    public function create($user)
    {
        $user = User::find($user);
        return view('backend.users.addresses.create')->with(['user' => $user]);
    }

    public function store(UsersAddressRequest $request, $user)
    {
        $user = User::find($user);
        if ($user) {
            try {
                Address::create([
                    'city' => $request->city,
                    'street' => $request->street,
                    'lng' => $request->lng,
                    'lat' => $request->lat,
                    'notes' => $request->notes,
                    'user_id' => $user->id
                ]);

                Session::flash('k', 'New Address has been added to ' . $user->first_name);
            } catch (\Exception $th) {
                Session::flash('err', 'something wrong');
            }
        } else
            Session::flash('err', 'this user not exist!!');

        return Redirect::back();
    }


    public function destroy($user,$address)
    {
        $address = Address::find($address);

        if($address->user_id =$user){
            $address->delete();
            Session::flash('k',"address has been deleted");
        }else{
            Session::flash('err','This address not belong to this user anymore');
        }

        return Redirect::back();
    }
}
