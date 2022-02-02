<?php

namespace App\Http\Traits\Api;

trait MapResponseTrait
{


    private function driveUrl($image)
    {
        return 'https://drive.google.com/uc?id=' . $image . '&export=media';
    }

    private function tail($snake)
    {
        $pieces = explode('/', $snake);
        $tail = end($pieces);
        return $tail;
    }

    public function imageUrl($image)
    {
        return $this->driveUrl($this->tail($image));
    }


    /**
     * Categories
     */
    public function mapCategories($categories)
    {
        return array_map(function ($var) {
            $res = [
                "id" => $var['id'],
                "name" => $var['name'],
                "piority" => $var['piority'],
                "image" => $this->imageUrl($var['image']),
                "color" => $var['color'],
                "description" => $var['description']
            ];
            return $res;
        }, $categories->toArray());
    }

    /**
     * Sub Categories
     */
    public function mapSubs($subs)
    {
        return array_map(function ($var) {
            $res = [
                "id" => $var['id'],
                "name" => $var['name'],
                "piority" => $var['piority'],
                "image" => $this->imageUrl($var['image']),
                "color" => $var['color'],
                "description" => $var['description'],
                "cat_id" => $var['cat_id']
            ];
            return $res;
        }, $subs->toArray());
    }

    /**
     * Brands
     */
    public function mapBrands($brands)
    {
        return array_map(function ($var) {
            $res = [
                'id' => $var['id'],
                'name' => $var['name'],
                'image' => $this->imageUrl($var['image']),
                'color' => $var['color']
            ];
            return  $res;
        }, $brands->toArray());
    }


    /**
     * Product
     */
    private function mapProduct($product, $gallary = false)
    {
        //dd($product['images']);
        //$product = $gallary ? $product->toArray()[0] : $product; // back to here again <-----------
        return [
            "id" => $product['id'],
            "name" => $product['name'],
            "price" => $product['price'],
            "quantities" => $product['quantities'],
            "sold_times" => $product['sold_times'],
            "discount" => $product['discount'],
            "rating" => $product['rating'],
            "weight" => $product['weight'],
            "color" => $product['color'],
            "notes" => $product['notes'],
            "subcat_id" => $product['subcat_id'],
            "brand_id" => $product['brand_id'],
            "images" => $this->proImages($product['images'], $gallary),
        ];
    }


    /**
     * Products
     * @param Products $products
     * @param boolean $gallary
     */
    public function mapProducts($products, $gallary = false)
    {
        return array_map(function ($var) use ($gallary) {
            $res = $this->mapProduct($var, $gallary);
            return $res;
        }, $products->toArray());
    }

    /**
     * Prodcuts images
     */
    public function proImages($images, $gallary = false)
    {
        //dd((array)$images);
        // dd(gettype((array) $images));
        $all = array_map(function ($var) {
            $res = [
                "image" => $this->imageUrl($var['image']),
                "type" => $var['type'],
            ];

            return $res;
        }, (array) $images);

        if (!$gallary)
            $all = array_filter($all, function ($var) {
                return $var['type'] == 'main';
            });

        return $all;
    }
}
