@extends('backend.layouts.app')
@section('content')
    @include('backend.unique.sessions')
    <div class="col-md-6 m-auto stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add new Brand</h4>

                <form class="forms-sample" method="POST" action="{{ Route('brands.store') }}"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="exampleInputCategory1">Brand name</label>
                        <input type="text" class="form-control" id="exampleInputCategory1" placeholder="" name="name"
                            value="{{ old('name') }}">

                        @error('name')
                            <small class="text-danger">{{ $errors->first('name') }}</small>
                        @enderror

                    </div>
                   
                    
                    <div class="form-group">
                        <label for="exampleInputEmail1">Image</label>
                        <input type="file" class="form-control" id="exampleInputEmail1" accept="image/*" name="image"
                            value="{{ old('image') }}">

                        @error('image')
                            <small class="text-danger">{{ $errors->first('image') }}</small>
                        @enderror

                    </div>
                    <div class="form-group">
                        <label for="exampleInputColor">Color</label>
                        <input type="color" class="form-control" id="exampleInputColor1" placeholder="color" name="color"
                            value="{{ old('color') }}">

                        @error('color')
                            <small class="text-danger">{{ $errors->first('color') }}</small>
                        @enderror

                    </div>


                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                </form>
            </div>
        </div>
    </div>
@endsection
