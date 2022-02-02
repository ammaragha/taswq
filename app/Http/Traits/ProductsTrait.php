<?php

namespace App\Http\Traits;

use App\ProductImage;

trait ProductsTrait
{
    use GoogleDriveTrait;



    public function uploadMain($file, $folder, $parent,$product_id)
    {
        $dirId = $this->dirID($folder, $parent);
        ProductImage::create([
            'image' => $this->driveStore($file,$dirId),
            'piority' => 1,
            'type' => 'main',
            'pro_id' => $product_id
        ]);
    }

    public function uploadGallary($files, $folder, $parent, $product_id)
    {
        $dirId = $this->dirID($folder, $parent);
        foreach ($files as $file) {
            ProductImage::create([
                'image' => $this->driveStore($file, $dirId),
                'piority' => 2,
                'type' => 'gallary',
                'pro_id' => $product_id
            ]);
        }
    }
}
