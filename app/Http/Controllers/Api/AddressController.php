<?php

namespace App\Http\Controllers\Api;

use App\Address;
use App\Http\Controllers\Controller;
use App\Http\Traits\Api\ResponseTrait;
use Illuminate\Http\Request;

use Auth;

class AddressController extends Controller
{

    use ResponseTrait;

    public function View()
    {
        return $this->succWithData(Auth::user()->addresses);
    }

    public function checkAddress($id)
    {
        return Address::where('id', $id)->where('user_id', Auth::user()->id);
    }

    public function create(Request $request)
    {
        try {
            $data = Address::create([
                'city' => $request->city,
                'street' => $request->street,
                'lng' => $request->lng,
                'lat' => $request->lat,
                'notes' => $request->notes,
                'user_id' => Auth::user()->id
            ]);
            return $this->succWithData($data, 'Address Added');
        } catch (\Exception $th) {
            return $this->errMsg('Something went wrong');
        }
    }

    public function usability($id)
    {
        try {
            Address::where('user_id', Auth::user()->id)->update([ //turn off all addresses
                'usability' => 0
            ]);
            $data = $this->checkAddress($id)->update([ // turn on this one
                'usability' => 1
            ]);
            return $this->succMsg('This address is now on use');
        } catch (\Exception $th) {
            return $this->errMsg('something wrong');
        }
    }

    public function destroy($id)
    {
        try {
            $address = $this->checkAddress($id)->delete();
            if ($address)
                return $this->succMsg('Address deleted');
            else
                return $this->errMsg('this address not exist or not belong to this user');
        } catch (\Exception $th) {
            return $this->errMsg('something wrong');
        }
    }
}
