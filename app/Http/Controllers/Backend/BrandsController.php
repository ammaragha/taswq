<?php

namespace App\Http\Controllers\Backend;

use App\Brand;
use App\Http\Controllers\Controller;
use App\Http\Traits\GoogleDriveTrait;
use App\Http\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class BrandsController extends Controller
{

    use ImageTrait,GoogleDriveTrait;
    public $folderName = 'Brands'; // for Categories images folder

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //for search
        if (isset($_GET['search'])) {
            $data = Brand::where([
                ['name', 'Like', "%" . $_GET['search'] . "%"],
            ])->paginate(5);
        } else
            $data = Brand::paginate(5);
            
        return view('backend.brands.index')->with(['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {
            Brand::create([
                'name' => $request->name,
                'image' => $this->driveUpload($request->image,$this->folderName),
                'color' => $request->color
            ]);
            Session::flash('k', 'Brand added');
        } catch (\Exception $th) {
            Session::flash('err', $th->getMessage());
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
        $data = Brand::find($id);
        if ($data)
            return view('backend.brands.edit')->with(['data' => $data]);
        else
            return Redirect::route('brands.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $brand = Brand::find($id);
        if ($brand) {
            try {
                $brand->name = $request->name;
                $brand->image = $this->driveUpdate($brand->image, $request->image, $this->folderName);
                $brand->color = $request->color;

                $brand->Save();

                Session::flash('k','Brand has been Updated');
            } catch (\Exception $th) {
                Session::flash('err','Something wrong');
            }
        }
        return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Brand::find($id);
        if($data){
            $this->driveDelete($data->image);
            $data->delete();
            Session::flash('k','brand has been deleted!');
        }else{
            Session::flash('err','what do you do ?');
        }

        return Redirect::back();
    }
}
