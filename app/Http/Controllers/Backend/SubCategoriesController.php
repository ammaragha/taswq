<?php

namespace App\Http\Controllers\Backend;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SubCategoryRequest;
use App\Http\Traits\GoogleDriveTrait;
use Illuminate\Http\Request;
use App\SubCategory;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class SubCategoriesController extends Controller
{

    use GoogleDriveTrait;
    public $imgPath = 'SubCategories'; // for sub-Categories images folder

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //for search
        if (isset($_GET['search'])) {
            $data = SubCategory::where([
                ['name', 'Like', "%" . $_GET['search'] . "%"],
            ])->get();
        } else
            $data = SubCategory::get();

        return view('backend.subcategories.index')->with(['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.subcategories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubCategoryRequest $request)
    {
        try {
            SubCategory::create([
                'name' => $request->name,
                'piority' => $request->piority,
                'description' => $request->description,
                'color' => $request->color,
                'cat_id' => $request->cat_id,
                'image' => $this->driveUpload($request->image, $this->imgPath),
            ]);

            Session::flash('k', 'Sub-Category has been added');
        } catch (\Exception $th) {
            Session::flash('err', 'Something wrong');
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
        $data = SubCategory::find($id);
        if ($data)
            return view('backend.subcategories.edit')->with(['data' => $data]);
        return Redirect::back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubCategoryRequest $request, $id)
    {
        try {
            $sub = SubCategory::find($id);
            $sub->name = $request->name;
            $sub->piority = $request->piority;
            $sub->description = $request->description;
            $sub->color = $request->color;
            $sub->image = $this->driveUpdate($sub->image, $request->image, $this->imgPath);

            $sub->save();

            Session::flash('k', 'Sub-category has been updated!');
        } catch (\Exception $th) {
            Session::flash('err', 'Something wrong');
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
        try {
            $data = SubCategory::find($id);
            $this->driveDelete($data->image);
            $data->delete();

            Session::flash('k', 'Sub-Category has been deleted!');
        } catch (\Exception $th) {
            Session::flash('err', 'Somthing Wrong');
        }
        return Redirect::back();
    }
}
