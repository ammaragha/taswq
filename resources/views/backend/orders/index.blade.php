@extends('backend.layouts.app')

@section('content')


    <h2 class="text-center mb-5">Show all Orders</h2>
    <div class="row m-3">

        {{-- search bar --}}

        <div class="col-4 ">
            <form action="{{ Route('orders.index') }}">
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
                                <th>Data</th>
                                <th>Status</th>
                                <th>Start</th>
                                <th>Arrive</th>
                                <th>Total price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($data) && count($data) > 0)
                                @foreach ($data as $key => $order)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td>{{$order->cart->user->first_name}}</td>
                                        <td>{{ $order->created_at }}</td>
                                        <td>{{ $order->status }}</td>
                                        <td>{{ $order->start }}</td>
                                        <td>{{ $order->arrival }}</td>
                                        <td>{{ $order->total_price }}</td>
                                        <td>
                                            {{-- <form method="POST" action="{{ Route('categories.destroy', $cat->id) }}">
                                                @csrf
                                                @method('Delete')
                                                <a href="{{ Route('categories.edit', $cat->id) }}"
                                                    class="btn btn-sm btn-success ">
                                                    <i class="ti-marker-alt"></i>
                                                    Edit
                                                </a>
                                                <button class="btn btn-sm btn-danger confirm">
                                                    <i class="ti-trash"></i>
                                                    Delete
                                                </button>
                                            </form> --}}
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
