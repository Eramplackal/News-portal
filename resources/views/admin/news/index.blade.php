@extends('admin.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">News Articles</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <a href="{{ route('news.create') }}" class="btn btn-primary mb-4">Add News</a>

        <div class="row">
            @forelse($newsList as $news)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        @if ($news->image)
                            <img src="{{ Storage::url($news->image) }}" class="card-img-top" alt="{{ $news->title }}"
                                style="height: 200px; object-fit: cover;">
                        @else
                            <img src="https://via.placeholder.com/400x200?text=No+Image" class="card-img-top"
                                alt="No Image">
                        @endif

                        <div class="card-body">
                            <h5 class="card-title">{{ $news->title }}</h5>
                            <p class="card-text">{{ \Illuminate\Support\Str::limit(strip_tags($news->description), 100) }}
                            </p>
                        </div>

                        <div class="card-footer text-end">
                            <a href="{{ route('news.edit', base64_encode($news->id)) }}"><i class="fas fa-edit text-warning"
                                    title="Edit" class="mx-2"></i></a>
                            <a href="{{ route('news.destroy', base64_encode($news->id)) }}"
                                onclick="return confirm('Are you sure you want to delete this news?')"><i
                                    class="fas fa-trash text-danger" title="Delete" class="mx-2"></i></a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-muted">No news articles found.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
