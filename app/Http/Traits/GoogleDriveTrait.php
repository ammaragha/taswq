<?php

namespace App\Http\Traits;

use App\Product;
use Illuminate\Support\Facades\Storage;

trait GoogleDriveTrait
{
    /**
     * hold google drive disk
     */
    private function drive()
    {
        return Storage::disk('google');
    }

    /**
     * @param mixed item
     * @return url
     */
    public function getUrl($item)
    {
        return Storage::disk('google')->url($item);
    }

    /**
     * to get ID of item from url
     * @param mixed item
     * @return id
     */
    public function getId($item)
    {
        $url = $this->getUrl($item);
        $arr = explode('/', $url);
        $last = end($arr);
        $temp = explode('&export', $last)[0];
        $temp = explode('?id=', $temp);
        return end($temp);
    }

    //-------------------------------------------------------------------------------------
    /**
     * to make a new Directory
     * @param string name
     * @return id
     */
    public function makeDir($name, $parent = null)
    {
        $path = $name; //set path
        if (!is_null($parent))
            $path = $parent . '/' . $name; //set path with parent
        $allDir = $this->drive()->directories($parent); // get all dir ids
        //dump($allDir);
        $ids = array_filter($allDir, function ($item) use ($name) { //filter them and return file if exist
            $arr = $this->drive()->getMetaData($item);
            return $arr['filename'] == $name;
        });
        //dump($ids);
        if (count($ids) == 0) { //create new one if not exist
            $this->drive()->makeDirectory($path);
            array_push($ids, $this->getId($path));
        }

        //dd(reset($ids));
        return reset($ids); // return result id
    }

    /**
     * for making a new sub Directory
     * @param string parent
     * @param string name
     * @return id
     */
    public function makeSubDir($parent, $name)
    {
        $father = $this->makeDir($parent);
        //dump($father);
        $child = $this->makeDir($name, $father);
        //dd($child);
        return $father . '/' . $child;
    }

    /**
     * for deleteing Directory depend on degree [0=currnt , 1=parent, 2=parent of parent, ....]
     * @param id full path
     * @param int degree
     * @return boolean
     */
    public function deleteDir($dir,$degree = 0)
    {
        $dir = array_reverse(explode('/',$dir)); //exploade and reverse
        if($degree >= count($dir)) //if degree more than length
            $degree = count($dir)-1;
        return $this->drive()->deleteDirectory($dir[$degree]); //delete depend on degree
    }
    //-------------------------------------------------------------------------------------

    /**
     * to upload file to drive
     * @param Request file 
     * @param string path
     * @return id
     */
    public function driveUpload($file, $folder, $parent = null)
    {
        if (!is_null($parent))
            $dirId = $this->makeSubDir($parent, $folder); //create subDir
        else
            $dirId = $this->makeDir($folder); //create Dir


        $temp = $file->store($dirId, 'google'); // Store file
        $fileId = $this->getId($temp);
        return $dirId . '/' . $fileId;
    }

    /**
     * to update file
     * @param id old
     * @param Request new
     * @param string path
     */
    public function driveUpdate($old, $new, $path)
    {
        $this->driveDelete($old);
        return $this->driveUpload($new, $path);
    }

    /**
     * to delete file
     * @param id file
     * @return boolean
     */
    public function driveDelete($file)
    {
        return $this->drive()->delete($file);
    }
}
