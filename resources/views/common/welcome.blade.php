@extends('common.common')

@section('content')
<div class="container">
    <h1 class="mb-4">Latest News by Category</h1>

    @php
        $hasNews = false;
    @endphp

    @foreach ($categories as $category)
        @if ($category->news->isNotEmpty())
            @php $hasNews = true; @endphp
            <h3 class="mt-5">{{ $category->name }}</h3>
            <div class="row">
                @foreach ($category->news as $news)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            @if ($news->image)
                                <img src="{{ Storage::url($news->image) }}" class="card-img-top" alt="{{ $news->title }}" style="height: 200px; object-fit: cover;">
                            @else
                                <img src="https://via.placeholder.com/400x200?text=No+Image" class="card-img-top" alt="No Image">
                            @endif

                            <div class="card-body">
                                <h5 class="card-title">{{ $news->title }}</h5>
                                <p class="card-text">{{ \Illuminate\Support\Str::limit(strip_tags($news->description), 100) }}</p>
                            </div>

                            <div class="card-footer bg-white">
                                <h6>Comments:</h6>
                                @forelse ($news->comments as $comment)
                                    <div class="mb-2 border-start ps-2">
                                        <strong>{{ $comment->name }}</strong> {{ $comment->comment }}
                                    </div>
                                @empty
                                    <p class="text-muted">No comments yet.</p>
                                @endforelse

                                <form action="{{ route('comment.store') }}" method="POST" class="mt-2">
                                    @csrf
                                    <input type="hidden" name="news_id" value="{{ $news->id }}">
                                    <div class="mb-2">
                                        <textarea name="comment" class="form-control" rows="2" placeholder="Write a comment..." required></textarea>
                                    </div>
                                    <button class="btn btn-sm btn-primary">Post Comment</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    @endforeach

    @if (!$hasNews)
        <div class="alert alert-info text-center mt-5">
            No news articles available.
        </div>
    @endif
</div>
@endsection
