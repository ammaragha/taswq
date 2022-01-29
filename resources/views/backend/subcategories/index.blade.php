@extends('backend.layouts.app')

@section('content')


    <h2 class="text-center mb-5">Show all Sub-Categories</h2>
    <div class="row m-3">

        {{-- search bar --}}

        <div class="col-4 ">
            <form action="{{ Route('subcategories.index') }}">
                @csrf
                <div class="input-group">
                    <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                        <span class="input-group-text" id="search">
                            <i class="icon-search"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control " id="navbar-search-input" placeholder="Search now"
                        aria-label="search" aria-describedby="search" name="search" value="@if (isset($_GET['search'])){{ $_GET['search'] }}@endif">
                </div>
            </form>

        </div>
        {{-- end search bar --}}


        {{-- add new user button --}}
        <div class="offset-5 col-3 ">
            <a href="{{ Route('subcategories.create') }}" class="btn btn btn-primary">
                <div class="row">
                    <i class="icon-plus col-1" aria-hidden="true"></i>
                    <span class="col-10">add new Sub-Category</span>
                </div>
            </a>
        </div>
        {{-- end add new user button --}}


    </div>
    @include('backend.unique.sessions')

    {{-- Start table --}}
    <div class="col-12  stretch-card">
        <div class="card">
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Piority</th>
                                <th>Color</th>
                                <th>Main Category</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($data) && count($data) > 0)
                                @foreach ($data as $key => $sub)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td><img src="{{ Storage::disk('google')->url($sub->image) }}"> </td>
                                        <td>{{ $sub->name }}</td>
                                        <td>{{ $sub->piority }}</td>
                                        <td>
                                            <div class="btn btn-sm" style="background-color: {{ $sub->color }}">
                                                {{ $sub->color }}
                                            </div>
                                        </td>
                                        <td>{{ $sub->cat->name }}</td>
                                        <td>
                                            <form method="POST" action="{{ Route('subcategories.destroy', $sub->id) }}">
                                                @csrf
                                                @method('Delete')
                                                <a href="{{ Route('subcategories.edit', $sub->id) }}"
                                                    class="btn btn-sm btn-success ">
                                                    <i class="ti-marker-alt"></i>
                                                    Edit
                                                </a>
                                                <button class="btn btn-sm btn-danger confirm">
                                                    <i class="ti-trash"></i>
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="text-center" colspan="8">No data!</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- end table --}}
@endsection
