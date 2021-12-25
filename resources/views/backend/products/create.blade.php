@extends('backend.layouts.app')
@section('content')
    @include('backend.unique.sessions')
    <div class="col-md-6 m-auto stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add new Product</h4>

                <form class="forms-sample" method="POST" action="{{ Route('products.store') }}"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="exampleInputCategory1">Product name</label>
                        <input type="text" class="form-control" id="exampleInputCategory1" placeholder="" name="name"
                            value="{{ old('name') }}">

                        @error('name')
                            <small class="text-danger">{{ $errors->first('name') }}</small>
                        @enderror

                    </div>

                    <div class="form-group">
                        <label for="exampleInputCategory1">Product Price</label>
                        <input type="text" class="form-control" id="exampleInputCategory1" placeholder="" name="price"
                            value="{{ old('price') }}">

                        @error('price')
                            <small class="text-danger">{{ $errors->first('price') }}</small>
                        @enderror

                    </div>

                    <div class="form-group">
                        <label for="exampleInputCategory1">Discount</label>
                        <input type="text" class="form-control" id="exampleInputCategory1" placeholder="0.00 %"
                            name="discount" value="{{ old('discount') }}">

                        @error('discount')
                            <small class="text-danger">{{ $errors->first('discount') }}</small>
                        @enderror

                    </div>

                    <div class="form-group">
                        <label for="exampleInputCategory1">Quantities</label>
                        <input type="number" min="0" class="form-control" id="exampleInputCategory1" placeholder=""
                            name="quantities" value="{{ old('quantities') }}">

                        @error('quantities')
                            <small class="text-danger">{{ $errors->first('quantities') }}</small>
                        @enderror

                    </div>

                    <div class="form-group">
                        <label for="exampleInputCategory1">Product availability</label>
                        <input type="checkbox" class="form-control" id="exampleInputCategory1" placeholder=""
                            name="availability" value="1" checked>



                    </div>
                    <hr>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Sub Category</label>
                        <select class="form-control" id="exampleFormControlSelect1" required name="subcat_id">
                            <option value="">..</option>
                            @foreach (App\SubCategory::get() as $subcat)
                                <option value="{{ $subcat->id }}">{{ $subcat->name }}</option>
                            @endforeach

                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Brand</label>
                        <select class="form-control" id="exampleFormControlSelect1" required name="brand_id">
                            <option value="">..</option>
                            @foreach (App\Brand::get() as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach

                        </select>
                    </div>
                    <hr>

                    <div class="form-group">
                        <label for="exampleInputColor">Color</label>
                        <input type="text" class="form-control" id="exampleInputColor1" placeholder="color" name="color"
                            value="{{ old('color') }}">

                        @error('color')
                            <small class="text-danger">{{ $errors->first('color') }}</small>
                        @enderror

                    </div>

                    <div class="form-group">
                        <label for="exampleInputCategory1">Product Weight</label>
                        <input type="text" class="form-control" id="exampleInputCategory1" placeholder="" name="weight"
                            value="{{ old('weight') }}">

                        @error('weight')
                            <small class="text-danger">{{ $errors->first('weight') }}</small>
                        @enderror

                    </div>

                    <div class="form-group">
                        <label for="Notes">Notes</label>
                        <textarea name="notes" class="form-control" id="notes" cols="30" rows="10"
                            placeholder="Write some notes about product">{{ old('notes') }}</textarea>

                        @error('notes')
                            <small class="text-danger">{{ $errors->first('notes') }}</small>
                        @enderror

                    </div>

                    <div class="form-group">


                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <button class="btn btn-light">Cancel</button>
                </form>
            </div>
        </div>
    </div>
@endsection
