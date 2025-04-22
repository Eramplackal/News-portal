@extends('admin.app')

@section('content')
<div class="container">
    <h2 class="mb-4">Add News</h2>

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

    <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">News Title</label>
            <input type="text" name="title" class="form-control" id="title" value="{{ old('title') }}" required>
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Select Category</label>
            <select name="category_id" class="form-select" id="category_id" required>
                <option value="">-- Select Category --</option>
                @foreach ($categories as $cat)
                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">News Description</label>
            <textarea name="description" class="form-control" id="description" rows="5" required>{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="media_file" class="form-label">News Image</label>
            <input type="file" name="media_file" class="form-control" id="media_file" accept="image/*" onchange="previewImage(event)">
            <div class="form-text">Image preview will appear below.</div>
            <img id="image-preview" src="#" alt="Preview" style="display:none; margin-top:10px; max-height:200px;">
        </div>

        <button type="submit" class="btn btn-success">Submit</button>
        <a href="{{ route('news.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection


<script>
    function previewImage(event) {
        const reader = new FileReader();
        const imagePreview = document.getElementById('image-preview');
        reader.onload = function() {
            imagePreview.src = reader.result;
            imagePreview.style.display = 'block';
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
