@extends('layouts.app')

@section('content')
    <style>
        .like {
            display: inline-flex;
        }
    </style>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                        <div class="input-group mb-3">
                            <form action="/create-status" method="post" class="form-control">
                                @csrf
                                <input type="text" class="form-control" name="description"
                                       aria-describedby="button-addon">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="submit" id="button-addon">Post
                                    </button>
                                </div>
                            </form>
                        </div>


                    </div>
                </div>
            </div>
        </div>


        {{ auth()->user()->role->name }}


        <div class="row justify-content-center">
            <div class="col-8">
                @foreach($statuses as $s)

                    <div class="row">
                        <div class="col-2">
                            {{ $s->user->name }}:
                        </div>
                        <div class="col-8">
                            {{ $s->description }}

                            <div class="like">
                                <form action="/status/{{ $s->id }}/like" method="post">
                                    @csrf
                                    <button type="submit" class="btn">👍</button>
                                </form>
                            </div>


                            <div class="like">
                                <form action="/status/{{ $s->id }}/unlike" method="post">
                                    @csrf
                                    <button type="submit" class="btn">👎</button>
                                </form>
                            </div>


                            <p>
                                @foreach($s->likes as $index => $like)
                                    {{ $like->name }}@if($index !== $s->likes->count() - 1), @endif
                                @endforeach
                            </p>

                        </div>
                        <div class="col-2">{{ $s->created_at->diffForHumans() }}</div>
                    </div>
                @endforeach
            </div>
        </div>


    </div>
@endsection
