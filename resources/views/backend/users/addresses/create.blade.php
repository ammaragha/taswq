@extends('backend.layouts.app')

@section('content')
    @include('backend.unique.sessions')
    <div class="col-md-6 m-auto stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">New address for <strong>( {{ $user->first_name }} )</strong></h4>

                <form class="forms-sample" method="POST" action="{{ Route('users.addresses.store',['user'=>$user->id]) }}">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputUsername1">City</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="city"
                            value="{{ old('city') }}">

                        @error('city')
                            <small class="text-danger">{{ $errors->first('city') }}</small>
                        @enderror

                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">Street</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="street"
                            value="{{ old('street') }}">

                        @error('street')
                            <small class="text-danger">{{ $errors->first('street') }}</small>
                        @enderror

                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">lng</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="lng"
                            value="{{ old('lng') }}">



                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">lat</label>
                        <input type="text" class="form-control" id="exampleInputUsername1" placeholder="" name="lat"
                            value="{{ old('lat') }}">



                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">notes</label>
                        <textarea name="notes" id="exampleInputUsername1" class="form-control" cols="30"
                            rows="10">{{ old('notes') }}</textarea>



                    </div>



                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                </form>
            </div>
        </div>
    </div>
@endsection
