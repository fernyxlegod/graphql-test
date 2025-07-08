@extends('layouts.app')
@use('Illuminate\Support\Str')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="mb-0">{{ $user->name ?? 'Unknown User' }}</h2>
                            <div class="text-muted small">
                                <i class="bi bi-calendar me-1"></i>
                                Member since: {{ $user->created_at->format('d M Y, H:i') ?? 'Unknown date' }}
                            </div>
                        </div>
                        @auth
                            @if(auth()->user()->id === $user->id)
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                                            id="userActionsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-gear"></i> Actions
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="userActionsDropdown">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                                <i class="bi bi-pencil me-1"></i> Edit Profile
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            @endif
                        @endauth
                    </div>

                    <div class="card-body">
                        <div class="user-info py-3">
                            <div class="mb-3">
                                <strong><i class="bi bi-envelope me-1"></i> Email:</strong>
                                <a href="mailto:{{ $user->email }}">{{ $user->email ?? 'No email' }}</a>
                            </div>
                            <div class="mb-3">
                                <strong><i class="bi bi-file-post me-1"></i> Total posts:</strong>
                                <span class="badge bg-primary rounded-pill">
                                {{ $user->posts->count() }}
                            </span>
                            </div>
                        </div>

                        <h4 class="mt-4 border-top pt-3">
                            <i class="bi bi-newspaper me-2"></i>Latest Posts
                        </h4>

                        @forelse($user->posts as $post)
                            <div class="card mb-3">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        <a href="{{ route('posts.show', $post) }}" class="text-decoration-none">
                                            {{ $post->title }}
                                        </a>
                                    </h5>
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <small class="text-muted">
                                            <i class="bi bi-clock me-1"></i>
                                            {{ $post->created_at->format('d M Y') }}
                                        </small>
                                        <small class="text-muted">
                                            <i class="bi bi-arrow-repeat me-1"></i>
                                            Updated: {{ $post->updated_at->format('d M Y H:i') }}
                                        </small>
                                    </div>
                                    <p class="card-text">{{ Str::limit(strip_tags($post->content), 200) }}</p>
                                    <a href="{{ route('posts.show', $post) }}" class="btn btn-sm btn-outline-primary">
                                        Read more <i class="bi bi-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="alert alert-info mt-3">
                                <i class="bi bi-info-circle me-2"></i>
                                This user hasn't posted anything yet.
                            </div>
                        @endforelse

                        <div class="mt-4 border-top pt-3">
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('users.index') }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-people me-1"></i> All Users
                                </a>
                                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-left me-1"></i> Back
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
