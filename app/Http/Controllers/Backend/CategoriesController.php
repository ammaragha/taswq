<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Category;
use App\Http\Requests\Admin\CategoryRequest;
use App\Http\Traits\GoogleDriveTrait;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CategoriesController extends Controller
{
    use GoogleDriveTrait;
    public $folderName = 'Categories'; // for Categories images folder

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //for search
        if (isset($_GET['search'])) {
            $data = Category::where([
                ['name', 'Like', "%" . $_GET['search'] . "%"],
            ])->get();
        } else
            $data = Category::get();

        return view('backend.categories.index')->with(['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        try {
            Category::create([
                'name' => $request->name,
                'piority' => $request->piority,
                'description' => $request->description,
                'color' => $request->color,
                'image' => $this->driveUpload($request->image, $this->folderName),
            ]);

            Session::flash('k', 'New category has been added!');
        } catch (\Exception $th) {
            Session::flash('err', 'Something went wrong!' . $th->getMessage());
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
        $data = Category::find($id);
        if ($data) {
            return view('backend.categories.edit')->with(['data' => $data]);
        }
        return Redirect::back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $cat = Category::find($id);
        if ($cat) {
            $old = $cat->image;
            if (is_null($request->image))
                $image = $old;
            else
                $image = $this->driveUpdate($cat->image, $request->image, $this->folderName);

            //start updating
            $cat->name = $request->name;
            $cat->piority = $request->piority;
            $cat->description = $request->description;
            $cat->image = $image;
            $cat->color = $request->color;

            $cat->save();

            Session::flash('k', 'this Category has been updated');
        } else {
            Session::flash('err', 'what are you doing nub!');
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
        $data = Category::find($id);
        if($data){
            $this->driveDelete($data->image);
            $data->delete();
            Session::flash('k','Category has been deleted!');
        }else{
            Session::flash('err','what do you do ?');
        }

        return Redirect::back();
    }
}
