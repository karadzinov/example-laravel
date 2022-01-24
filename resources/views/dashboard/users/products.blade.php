@extends('layouts.dashboard')
@section('content')


    <table class="table">
        <thead></thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Created At</th>
            <th>Created By</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <tbody>

        @foreach($user->products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td><a href="/products/{{ $product->id }}">{{ $product->name }}</a></td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->created_at }}</td>
                <td>{{ $product->user->name }}</td>
                <td><a href="/products/{{ $product->id }}/edit" class="btn btn-warning">Edit</a></td>

                <td>
                    <form action="/products/{{ $product->id }}" method="post">
                        @csrf
                        @method('delete')
                        <button href="/products/{{ $product->id }}/edit" type="submit" class="btn btn-danger">Delete</button>
                    </form>

                </td>
            </tr>
        @endforeach


        </tbody>
    </table>

@endsection
