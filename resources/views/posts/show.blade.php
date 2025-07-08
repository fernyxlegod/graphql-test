@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title">{{ $post->title }}</h1>
                    <p class="card-text text-muted">
                        Posted on {{ $post->created_at->format('F j, Y') }} by {{ $post->user->name }}
                    </p>
                    <div class="card-text mt-4">
                        {!! nl2br(e($post->content)) !!}
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('posts.index') }}" class="btn btn-primary">Back to Posts</a>
            </div>
        </div>
    </div>
@endsection
