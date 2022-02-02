@extends('layouts.dashboard')
@section('content')



    <div class="row">
        <div class="col-8">
            <a href="/admin/categories/create" class="btn btn-primary">Create Category</a>
        </div>
    </div>
    <div class="row">
        <div class="col-8">
            {!! $categories !!}
        </div>
    </div>
@endsection
