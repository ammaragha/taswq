<?php

namespace App\Http\Traits;

use App\Product;
use Illuminate\Support\Facades\Storage;

trait GoogleDriveTrait
{
    private function drive()
    {
        return Storage::disk('google');
    }

    public function getId($name)
    {
        $url = $this->getUrl($name);
        $arr = explode('/', $url);
        $last = end($arr);
        $temp = explode('&export', $last)[0];
        $temp= explode('?id=',$temp);
        return end($temp);
    }

    public function getUrl($name)
    {
        return Storage::disk('google')->url($name);
    }

    public function makeDir($name)
    {
        $allDir = $this->drive()->directories(); // get all dir ids
        $ids = array_filter($allDir, function ($item) use ($name) { //filter them and return file if exist
            $arr = $this->drive()->getMetaData($item);
            return $arr['filename'] == $name;
        });

        if (count($ids) == 0) { //create new one if not exist
            $this->drive()->makeDirectory($name);
            $ids[1] = $this->getId($name);
        }
        //dd($ids);
        return $ids[1]; // return result id
    }

    /**
     * 
     */
    public function driverUpload($file, $path)
    {
        $dirId = $this->makeDir($path); //create Dir
        $temp = $file->store($dirId, 'google'); // Store file
        $fileId = $this->getId($temp);
        return $dirId . '/' . $fileId;
    }

    /**
     * 
     */
    public function driveUpdate($old,$new,$path)
    {
        $this->driverDelete($old);
        return $this->driverUpload($new,$path);
    }

    /**
     * 
     */
    public function driverDelete($file)
    {
        
        return $this->drive()->delete($file);
    }
}
