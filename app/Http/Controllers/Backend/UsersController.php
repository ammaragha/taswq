<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EditUserRequest;
use App\Http\Requests\Admin\SignUpRequest;
use App\Http\Traits\General;
use App\User;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{

    use General;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //for search
        if (isset($_GET['search'])) {
            $data = User::where([
                ['first_name', 'Like', "%" . $_GET['search'] . "%"],
            ])->where('role', '0')->get();
        } else
            $data = User::where('role', 0)->get();

        return view('backend.users.index')->with(['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SignUpRequest $request)
    {
        try {
            User::create($this->userRecord(
                $request,
                true
            ));

            Session::flash('k', 'User has been added');
        } catch (\Exception $th) {
            // return $th->getMessage();
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
        $data = User::find($id);
        if ($data){
            if(isset($_GET['verify']) && $_GET['verify']==1){
                $data->email_verified_at = date('Y-m-d h:i:s', time());
                $data->save();
                Session::flash('k',$data->email.' has been verified');
            }
                
        }
        return view('backend.users.show')->with(['data' => $data]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = User::find($id);
        if ($data)
            return view('backend.users.edit')->with(['data' => $data]);
        else
            return Redirect::back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditUserRequest $request, $id)
    {
        $pass = false;
        $email = false;
        $user = User::find($id);
        if ($user) {
            //-------------------------
            if (!empty($request->password)) {
                $pass = true;
                $matching = Validator::make($request->all(), [
                    'password' => 'required',
                    'confirm_password' => 'required|required_with:password|same:password',
                ]);
                if ($matching->fails()) {
                    return Redirect::back()->withErrors($matching);
                }
            }
            // --------------------
            if ($user->email != $request->email)
                $email = true;
            try {
                $user->update($this->userRecord(
                    $request,
                    $pass,
                    $email
                ));

                Session::flash('k', 'User has been Updated');
            } catch (\Exception $th) {
                // return $th->getMessage();
                Session::flash('err', "something went wrong");
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
        $user = User::find($id);
        if ($user) {
            $user->delete();
            Session::flash('k', 'User has been deleted!');
        } else {
            Session::flash('err', 'something goes wrong!!');
        }
        return Redirect::back();
    }
}
