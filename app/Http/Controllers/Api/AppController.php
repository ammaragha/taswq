<?php

namespace App\Http\Controllers\Api;

use App\Brand;
use App\Http\Controllers\Controller;
use App\Http\Traits\Api\ResponseTrait;
use App\Category;
use App\Product;
use App\SubCategory;
use Illuminate\Http\Request;

class AppController extends Controller
{
    use ResponseTrait;


    /**
     * return all categories ASC
     * @return response
     */
    public function categories()
    {
        $cats = Category::orderBy('piority','ASC')->get();
        $data = ['categories'=>$cats];
        return $this->succWithData($data);
    }

    /**
     * products which only belongs to specific category
     * @param cat_id
     * @return response
     */
    public function catProducts($id)
    {
        $ids=[];
        $subcats = Category::find($id)->subs()->get('id');
        foreach($subcats as $sub){
            array_push($ids,$sub->id);
        }
        $products = Product::whereIn('subcat_id',$ids)->with('images')->where('availability',1)->get();
        $data = ['products'=>$products];
        return $this->succWithData($data);
      }


    /**
     * all Subcategories 
     * @param cat_id 
     * @return response
     */
    public function subcategories($main)
    {
        $subcats = SubCategory::orderBy('piority','ASC')->where('cat_id',$main)->get();
        $data = ['subcategories'=>$subcats];
        return $this->succWithData($data);
    }

    /**
     * products which belongsto specific subcategory
     * @param subcat_id
     * @return response
     */
    public function subcatProducts($id)
    {
        $products = SubCategory::find($id)->products()->with('images')->where('availability',1)->get();
        $data = ['products'=>$products];
        return $this->succWithData($data);
    }

    /**
     * call all brands
     * @return response
     */
    public function brands()
    {
        $brands = Brand::get();
        $data = ['Brands'=>$brands];
        return $this->succWithData($data);
    }

    /**
     * products which belongs to specifi brand
     * @param brand_id
     * @return response
     */
    public function brandProducts($id)
    {
        $products = Brand::find($id)->products()->with('images')->where('availability',1)->get();
        $data = ['products'=>$products];
        return $this->succWithData($data);
    }

    /**
     * call a specific product
     * @param $id
     * @return response
     */
    public function product($id)
    {
        $product = Product::find($id)->with('images')->get();
        
        $data = ['product'=>$product];
        return $this->succWithData($data);
    }
}
