@extends('layouts.dashboard')
@section('content')

    <h1>{{ $user->name }}</h1>
    <h2>{{ $user->email }}</h2>

    <a href="{{ route('users.index') }}" class="btn btn-primary">Back</a>
@endsection
