@extends('layouts.dashboard')

@section('content')

    <a href="/admin/users/create" class="btn btn-info">Create User</a>
    <table class="table">
        <thead></thead>
        <tr>
            <th>ID</th>
            <th>Image</th>
            <th>Name</th>
            <th>Email</th>
            <th>Owned Products</th>
            <th>Created At</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
        <tbody>

        @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td><img src="/assets/img/users/thumbnails/{{ $user->image }}" alt="{{ $user->name }}" /></td>
                <td><a href="/users/{{ $user->id }}">{{ $user->name }}</a></td>
                <td>{{ $user->email }}</td>
                <td><a href="/users/{{ $user->id }}/products">{{ $user->products->count() }}</a></td>
                <td>{{ $user->created_at }}</td>
                <td><a href="/users/{{ $user->id }}/edit" class="btn btn-warning">Edit</a></td>

                <td>
                    <form action="/users/{{ $user->id }}" method="post">
                        @csrf
                         @method('delete')
                        <button href="/users/{{ $user->id }}/edit" type="submit" class="btn btn-danger">Delete</button>
                    </form>

                </td>
            </tr>
        @endforeach


        </tbody>
    </table>
@endsection


@section('scripts')
    <script>
        console.log('users');
    </script>
@endsection

