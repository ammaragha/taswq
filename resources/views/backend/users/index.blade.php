@extends('backend.layouts.app')

@section('content')


    <h2 class="text-center mb-5">Show all Users</h2>
    <div class="row m-3">

        {{-- search bar --}}
        <div class="nav-item nav-search   col-4 ">
            <div class="input-group">
                <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                    <span class="input-group-text" id="search">
                        <i class="icon-search"></i>
                    </span>
                </div>
                <input type="text" class="form-control " id="navbar-search-input" placeholder="Search now"
                    aria-label="search" aria-describedby="search">
            </div>
        </div>
        {{-- end search bar --}}

        

        {{-- add new user button --}}
        <div class="offset-6 col-2 ">
            <a href="{{ Route('users.create') }}" class="btn btn-primary">
                <i class="icon-plus mr-1" aria-hidden="true"></i>
                <span class="">add new user</span>
            </a>
        </div>
        {{-- end add new user button --}}


    </div>

    {{-- Start table --}}
    <div class="col-12  stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Hoverable Table</h4>
                <p class="card-description">
                    Add class <code>.table-hover</code>
                </p>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Product</th>
                                <th>Sale</th>
                                <th>Status</th>
                                <th>User</th>
                                <th>Product</th>
                                <th>Sale</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Jacob</td>
                                <td>Photoshop</td>
                                <td class="text-danger"> 28.76% <i class="ti-arrow-down"></i></td>
                                <td><label class="badge badge-danger">Pending</label></td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- end table --}}
@endsection
