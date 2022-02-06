<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductsRequest;
use App\Http\Traits\GoogleDriveTrait;
use App\Http\Traits\ProductsTrait;
use App\Product;
use App\ProductImage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ProductsController extends Controller
{
    use GoogleDriveTrait,ProductsTrait;
    public $folderName = 'Products'; // for Categories images folder



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //for search
        if (isset($_GET['search'])) {
            $data = Product::where([
                ['name', 'Like', "%" . $_GET['search'] . "%"],
            ])->paginate(5);
        } else
            $data = Product::paginate(5);

        return view('backend.products.index')->with(['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductsRequest $request)
    {
        if (is_null($request->availability))
            $request->availability = 0;
        try {
            $product_id = Product::create([
                'name' => $request->name,
                'price' => $request->price,
                'discount' => $request->discount,
                'quantities' => $request->quantities,
                'availability' => $request->availability,
                'subcat_id' => $request->subcat_id,
                'brand_id' => $request->brand_id,
                'color' => $request->color,
                'weight' => $request->weight,
                'notes' => $request->notes

            ])->id;

            $folder = $request->name . rand(); // to avoid th conflict
            if ($request->hasFile('image')) {
                $this->uploadMain($request->image,$folder,$this->folderName,$product_id);
            }

            if ($request->hasFile('images')) {
                $this->uploadGallary($request->images,$folder,$this->folderName,$product_id);
            }

            Session::flash('k', 'new product has  been added');
        } catch (\Exception $th) {
            Session::flash('err', "something went wrong");
        }

        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $data = Product::find($id);
        } catch (\Exception $th) {
            return Redirect::back();
        }
        return view('backend.products.edit')->with(['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductsRequest $request, $id)
    {
        $product = Product::find($id);
        if ($product) {
            if (is_null($request->availability))
                $request->availability = 0;
            try {
                $product->name = $request->name;
                $product->price = $request->price;
                $product->discount = $request->discount;
                $product->quantities = $request->quantities;
                $product->availability = $request->availability;
                $product->subcat_id = $request->subcat_id;
                $product->brand_id = $request->brand_id;
                $product->color = $request->color;
                $product->weight = $request->weight;
                $product->notes = $request->notes;

                $product->save();

                Session::flash('k', 'Product has been updated');
            } catch (\Exception $th) {
                Session::flash('err', 'Something wrong');
            }
            return Redirect::back();
        }
        return Redirect::route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Product::find($id);
        if ($data) {
            $this->deleteDir($data->images->where('type','main')->first()->image,1); //get full path to delete folder
            $data->delete();
            Session::flash('k', 'Product has been deleted!');
        } else {
            Session::flash('err', 'what do you do ?');
        }

        return Redirect::back();
    }
}
