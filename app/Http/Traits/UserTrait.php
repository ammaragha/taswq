<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

trait UserTrait
{


   
    /**
     * separate birthday to small paices (yy-mm-dd)
     * @param date
     * @return array
     */

    public function birthday($day)
    {
        $birthday = explode('-', $day);
        return [
            'yy' => $birthday[0],
            'mm' => $birthday[1],
            'dd' => $birthday[2]
        ];
    }

    /**
     * handle user Record and prepare it for store
     * @param request
     * @param passEnable false
     * @param emailEnable true
     * 
     * @return array
     */

    public function userRecord($request, $passEnable = false, $emailEnable = true)
    {
        $birthday = $this->birthday($request->birthday);
        $res = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'dd' => $birthday['dd'],
            'mm' => $birthday['mm'],
            'yy' => $birthday['yy'],
        ];

        if ($passEnable)
            $res = array_merge($res, ['password' => Hash::make($request->password),]);
        if ($emailEnable)
            $res = array_merge($res, ['email' => $request->email,]);

        return $res;
    }


}
