@extends('backend.layouts.app')

@section('content')
    @include('backend.unique.sessions')
    {{ $data->id }}
    @if (is_null($data->email_verified_at))
        {!! Form::Open(['method' => 'get']) !!}
        <input type="hidden" name="verify" value="1">
        <button class="btn btn-primary">verify</button>
        {!! Form::Close() !!}
    @endif

    @foreach ($data->addresses as $address)
        <div class="row m-2">
            <p class="col-10">{{ $address->city }}</p>
            <a href="{{ Route('users.addresses.destroy', ['user' => $data->id, 'address' => $address->id]) }}"
                class="btn btn-danger col-2 confirm">Delete</a>
        </div>
    @endforeach

    <a href="{{ Route('users.addresses.create', ['user' => $data->id]) }}" class="btn btn-success">Add new address</a>

@endsection
