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
                    <a href="{{ route('categories.edit', base64_encode($category->id)) }}" ><i class="fas fa-edit text-warning" title="Edit" class="mx-2"></i></a>
                    <a href="{{ route('categories.destroy', base64_encode($category->id)) }}"  onclick="return confirm('Are you sure you want to delete this category?')" ><i class="fas fa-trash text-danger" title="Delete" class="mx-2"></i></a>   

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