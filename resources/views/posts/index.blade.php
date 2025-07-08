@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">All Posts</h1>
        </div>

        @if($posts->isEmpty())
            <div class="card">
                <div class="card-body text-center py-5">
                    <h4 class="text-muted">No posts found</h4>
                    <p class="text-muted">Create your first post to get started</p>
                </div>
            </div>
        @else
            <div class="card shadow-sm">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Created At</th>
                            <th class="text-end">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>
                                    <a href="{{ route('posts.show', $post) }}" class="text-decoration-none">
                                        {{ Str::limit($post->title, 45) }}
                                    </a>
                                </td>
                                <td>{{ $post->user->name ?? 'Unknown' }}</td>
                                <td>{{ $post->created_at->format('d M Y, H:i') }}</td>
                                <td class="text-end">
                                    <div class="d-flex gap-2 justify-content-end">
                                        <a href="{{ route('posts.show', $post) }}" class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card-footer bg-white py-3">
                    <nav aria-label="Posts pagination">
                        {{ $posts->onEachSide(1)->links('pagination::bootstrap-5') }}
                    </nav>

                    <div class="text-center text-muted mt-2">
                        Showing {{ $posts->firstItem() }} to {{ $posts->lastItem() }} of {{ $posts->total() }} posts
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
