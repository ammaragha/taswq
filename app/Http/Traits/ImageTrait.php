<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\File;

trait ImageTrait
{


    public $imageFolder = '/Photos/';
    public $default = '/Photos/default.png';

   

    /**
     * handle image uploading process 
     * @param request $request->image
     * @param String $folderName on $imageFolder
     * @return String DBpath
     * 
     */
    public function uploadImage($image, $folderName)
    {
        if (is_null($image)) {
            return $this->default;
        } else {
            $path = $this->imageFolder . $folderName;
            $name = time() . '.' . $image->extension();
            $temp = public_path('/' . $path);
            $image->move($temp, $name);

            return $path . '/' . $name;
        }
    }

    /**
     * replace image on editing process
     * @param old
     * @param image
     * @param path
     * 
     * @return DBpath
     */

    public function replaceImage($old, $image, $path)
    {
        $this->delImage($path);
        return $this->uploadImage($image, $path);
    }

    public function delImage($path)
    {
        if ($path != $this->default)
            File::delete(public_path($path));


        return true;
    }
}
