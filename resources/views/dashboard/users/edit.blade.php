@extends('layouts.dashboard')

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card z-index-0 fadeIn3 fadeInBottom">
                <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                    <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                        <h4 class="text-white font-weight-bolder text-center mt-2 mb-0">Add User</h4>
                        <div class="row mt-3">

                        </div>
                    </div>
                </div>
                <div class="card-body">

                    <form role="form" class="text-start" method="post" action="/users/{{ $user->id }}">
                        @csrf
                        @method('put')

                        <div class="input-group input-group-outline my-3 ">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" onfocus="focused(this)" onfocusout="defocused(this)" value="{{ $user->name }}">
                        </div>




                        <div class="input-group input-group-outline my-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" onfocus="focused(this)" onfocusout="defocused(this)" value="{{ $user->email }}">
                        </div>



                        <div class="input-group input-group-outline mb-3 ">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" onfocus="focused(this)" onfocusout="defocused(this)">
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn bg-gradient-primary w-100 my-4 mb-2">Update</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
