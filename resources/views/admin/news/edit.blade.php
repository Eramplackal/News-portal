@extends('admin.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit News</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>There were some problems with your input:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">News Title</label>
            <input type="text" name="title" class="form-control" id="title" value="{{ old('title', $news->title) }}" required>
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Select Category</label>
            <select name="category_id" class="form-select" id="category_id" required>
                <option value="">-- Select Category --</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_id', $news->category_id) == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">News Description</label>
            <textarea name="description" class="form-control" id="description" rows="5" required>{{ old('description', $news->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="media_file" class="form-label">News Image</label>
            <input type="file" name="media_file" class="form-control" id="media_file" accept="image/*" onchange="previewImage(event)">
            <div class="form-text">Leave blank to keep existing image.</div>
        </div>

        <div class="mb-3">
            <label class="form-label d-block">Current / Preview Image:</label>
            <img id="preview" src="{{ $news->image ? Storage::url($news->image) : 'https://via.placeholder.com/400x200?text=No+Image' }}" class="img-fluid rounded shadow-sm" style="max-height: 200px;">
        </div>

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('news.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>

<script>
    function previewImage(event) {
        const output = document.getElementById('preview');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = () => URL.revokeObjectURL(output.src); // free memory
    }
</script>
@endsection
