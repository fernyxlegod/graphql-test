@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h2 class="mb-0">All Users</h2>
                    </div>

                    <div class="card-body">
                        <div class="list-group">
                            @forelse($users as $user)
                                <a href="{{ route('users.show', $user) }}"
                                   class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="mb-1">{{ $user->name }}</h5>
                                        <small class="text-muted">
                                            {{ $user->email }} •
                                            Registered: {{ $user->created_at->format('d M Y') }}
                                        </small>
                                    </div>
                                    <span class="badge bg-primary rounded-pill">
                                    {{ $user->posts_count }} {{ Str::plural('post', $user->posts_count) }}
                                </span>
                                </a>
                            @empty
                                <div class="alert alert-info">
                                    No users found.
                                </div>
                            @endforelse
                        </div>

                        <div class="mt-4">
                            {{ $users->links() }}
                        </div>

                        <div class="mt-4 border-top pt-3">
                            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-1"></i> Back
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
