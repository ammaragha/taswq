@extends('backend.layouts.app')
@section('content')
    @include('backend.unique.sessions')
    <div class="col-md-6 m-auto stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add new Sub-Category</h4>

                <form class="forms-sample" method="POST" action="{{ Route('subcategories.store') }}"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="exampleInputSubCategory1">Sub-Category name</label>
                        <input type="text" class="form-control" id="exampleInputSubCategory1" placeholder="" name="name"
                            value="{{ old('name') }}">

                        @error('name')
                            <small class="text-danger">{{ $errors->first('name') }}</small>
                        @enderror

                    </div>
                    <div class="form-group">
                        <label for="exampleInputDescription1">Description</label>
                        <textarea name="description" class="form-control" id="exampleInputDescription1" cols="30" rows="10"
                            placeholder="Write some description about SubCategory">{{ old('description') }}</textarea>

                        @error('description')
                            <small class="text-danger">{{ $errors->first('description') }}</small>
                        @enderror

                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Main Category</label>
                        <select class="form-control" id="exampleFormControlSelect1" required name="cat_id">
                            <option value="">..</option>
                            @foreach (App\Category::get() as $cat)
                                <option value="{{$cat->id}}">{{$cat->name}}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputSubCategory1">Piority</label>
                        <input type="number" min="1" class="form-control" id="exampleInputSubCategory1" placeholder=""
                            name="piority" value="{{ App\SubCategory::nextPiority(1) }}">

                        @error('piority')
                            <small class="text-danger">{{ $errors->first('piority') }}</small>
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
