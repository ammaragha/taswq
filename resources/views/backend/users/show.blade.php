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

@endsection
