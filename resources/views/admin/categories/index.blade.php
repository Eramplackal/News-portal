@extends('admin.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Categories</h2>

    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Add Category</a>

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>No</th>
                <th width="180px">Action</th>
                <th>Name</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline"
                        onsubmit="return confirm('Are you sure to delete?')">
                        @csrf
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
                <td>{{ $category->name }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4">No categories found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection