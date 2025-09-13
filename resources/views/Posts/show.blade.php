@extends('layouts.app2')

@section('content')
<div class="container my-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">{{ $post->title }}</h4>
        </div>
        <div class="card-body">
            <p class="card-text">
                {{ $post->body }}
            </p>
            @if($post->image)
                <div class="mb-3 text-center">
                    <img src="{{ asset('storage/'.$post->image) }}" 
                         alt="{{ $post->title }}" 
                         class="img-fluid rounded shadow-sm" 
                         style="max-height: 300px; object-fit: cover;">
                </div>
            @endif
            <p class="text-muted">
                <strong>Published at:</strong> {{ $post->published_at }}
            </p>
        </div>
        <div class="card-footer text-end">
            <a href="{{ route('posts', app()->getLocale()) }}" class="btn btn-secondary">
                Back to Posts
            </a>
            <a href="{{ route('posts.edit', [app()->getLocale(), $post->id]) }}" class="btn btn-primary">
                Edit Post
            </a>
        </div>
    </div>
</div>
@endsection
