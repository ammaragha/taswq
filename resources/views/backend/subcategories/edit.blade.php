@extends('backend.layouts.app')
@section('content')
    @include('backend.unique.sessions')
    <div class="col-md-6 m-auto stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <img style="width: 36px;height: 36px;border-radius: 100%;" src="{{ Storage::disk('google')->url($data->image) }}">
                    Edit {{ $data->name }}
                </h4>

                <form class="forms-sample" method="POST" action="{{ Route('subcategories.update', $data->id) }}"
                    enctype="multipart/form-data">
                    @method('PUT')
                    @csrf

                    <div class="form-group">
                        <label for="exampleInputCategory1">Sub-Category name</label>
                        <input type="text" class="form-control" id="exampleInputCategory1" placeholder="" name="name"
                            value="{{ $data->name }}">

                        @error('name')
                            <small class="text-danger">{{ $errors->first('name') }}</small>
                        @enderror

                    </div>
                    <div class="form-group">
                        <label for="exampleInputDescription1">Description</label>
                        <textarea name="description" class="form-control" id="exampleInputDescription1" cols="30" rows="10"
                            placeholder="Write some description about category">{{ $data->description }}</textarea>

                        @error('description')
                            <small class="text-danger">{{ $errors->first('description') }}</small>
                        @enderror

                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Main Category</label>
                        <select class="form-control" id="exampleFormControlSelect1" required name="cat_id">
                            @foreach (App\Category::get() as $cat)
                                <option @if ($cat->id == $data->cat_id)
                                    selected
                            @endif
                            value="{{ $cat->id }}">{{ $cat->name }}
                            </option>
                            @endforeach

                        </select>
                    </div>


                    <div class="form-group">
                        <label for="exampleInputCategory1">Piority</label>
                        <input type="number" min="1" class="form-control" id="exampleInputCategory1" placeholder=""
                            name="piority" value="{{ $data->piority }}">

                        @error('piority')
                            <small class="text-danger">{{ $errors->first('piority') }}</small>
                        @enderror

                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Image</label>
                        <input type="file" class="form-control" id="exampleInputEmail1" accept="image/*" name="image">

                        @error('image')
                            <small class="text-danger">{{ $errors->first('image') }}</small>
                        @enderror

                    </div>
                    <div class="form-group">
                        <label for="exampleInputColor">Color</label>
                        <input type="color" class="form-control" id="exampleInputColor1" placeholder="color" name="color"
                            value="{{ $data->color }}">

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
