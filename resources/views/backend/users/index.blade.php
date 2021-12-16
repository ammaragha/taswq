@extends('backend.layouts.app')

@section('content')


    <h2 class="text-center mb-5">Show all Users</h2>
    <div class="row m-3">

        {{-- search bar --}}

        <div class="col-4 ">
            <form action="{{ Route('users.index') }}">
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
        <div class="offset-6 col-2 ">
            <a href="{{ Route('users.create') }}" class="btn btn-primary">
                <i class="icon-plus mr-1" aria-hidden="true"></i>
                <span class="">add new user</span>
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
                                <th>User</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Orders No.</th>
                                <th>Product</th>
                                <th>Sale</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($data) && count($data) > 0)
                                @foreach ($data as $key => $user)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>
                                            <a href="{{ Route('users.show',$user->id) }}">
                                                {{ $user->first_name . ' ' . $user->last_name }}
                                            </a>
                                        </td>
                                        <td @if (is_null($user->email_verified_at)) class=" text-danger " title="not verified"@endif>
                                            {{ $user->email }}
                                        </td>
                                        <td>{{ $user->phone }}</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>
                                            <form method="POST" action="{{ Route('users.destroy', $user->id) }}">
                                                @csrf
                                                @method('Delete')
                                                <a href="{{ Route('users.edit', $user->id) }}"
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
