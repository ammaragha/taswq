@extends('backend.layouts.app')

@section('content')
    @include('backend.unique.sessions')
    <div class="col-md-6 m-auto stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit user</h4>

                <form class="forms-sample" method="POST" action="{{ Route('users.update', $data->id) }}">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputUsername1">First name</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="first_name"
                            value="{{ $data->first_name }}">

                        @error('first_name')
                            <small class="text-danger">{{ $errors->first('first_name') }}</small>
                        @enderror

                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">Last name</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="last_name"
                            value="{{ $data->last_name }}">

                        @error('last_name')
                            <small class="text-danger">{{ $errors->first('last_name') }}</small>
                        @enderror

                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">Phone</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="phone"
                            value="{{ $data->phone }}">

                        @error('phone')
                            <small class="text-danger">{{ $errors->first('phone') }}</small>
                        @enderror

                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">Birthdate</label>
                        <input type="date" class="form-control" id="exampleInputUsername1" placeholder="" name="birthday"
                            value="{{ $data->yy."-".$data->mm."-".$data->dd }}">

                        @error('birthday')
                            <small class="text-danger">{{ $errors->first('birthday') }}</small>
                        @enderror

                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="" name="email"
                            value="{{ $data->email }}">

                        @error('email')
                            <small class="text-danger">{{ $errors->first('email') }}</small>
                        @enderror

                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password"
                            name="password">

                        @error('password')
                            <small class="text-danger">{{ $errors->first('password') }}</small>
                        @enderror

                    </div>
                    <div class="form-group">
                        <label for="exampleInputConfirmPassword1">Confirm Password</label>
                        <input type="password" class="form-control" id="exampleInputConfirmPassword1"
                            placeholder="Password" name="confirm_password">

                        @error('confirm_password')
                            <small class="text-danger">{{ $errors->first('confirm_password') }}</small>
                        @enderror


                    </div>

                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                </form>
            </div>
        </div>
    </div>
@endsection
