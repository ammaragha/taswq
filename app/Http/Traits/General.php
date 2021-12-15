<?php

namespace App\Http\Traits;

trait General
{
    


    public function birthday($day)
    {
        $birthday = explode('-',$day);
        return [
            'yy'=>$birthday[0],
            'mm'=>$birthday[1],
            'dd'=>$birthday[2]
        ];
    }
}
