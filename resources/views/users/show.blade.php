@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body d-flex align-items-center">
                    <div class="me-2">
                        @if ($user->profile_image)
                            <img src="{{ asset('images/' . $user->profile_image) }}" alt="プロフィール画像" width="50" height="50" class="rounded-circle">
                        @else
                            <img src="{{ asset('default_profile_image.png') }}" alt="デフォルトプロフィール画像" width="50" height="50" class="rounded-circle">
                        @endif
                    </div>
                    <div class="flex-grow-1">
                        <h3 class="card-title mb-0">{{ $user->name }}</h3>
                    </div>
                    <div>
                        @if (auth()->user()->isFollowing($user))
                            <form action="{{ route('follow.destroy', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Unfollow</button>
                            </form>
                        @else
                            <form action="{{ route('follow.store', $user->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">Follow</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>

            <div class="mt-4">
                @foreach ($tweets as $tweet)
                    <div class="card mt-2 shadow-sm">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-2">
                                <a href="{{ route('users.show', $tweet->user->id) }}" class="d-flex align-items-center">
                                    @if ($tweet->user->profile_image)
                                        <img src="{{ asset('images/' . $tweet->user->profile_image) }}" alt="プロフィール画像" width="50" height="50" class="rounded-circle me-2">
                                    @else
                                        <img src="{{ asset('default_profile_image.png') }}" alt="デフォルトプロフィール画像" width="50" height="50" class="rounded-circle me-2">
                                    @endif
                                    <span class="fw-bold">{{ $tweet->user->name }}</span>
                                </a>
                                <small class="text-muted ms-2">{{ $tweet->created_at->diffForHumans() }}</small>
                            </div>
                            <p class="card-text">{{ $tweet->body }}</p>

                            <div class="mt-2">
                                @if ($tweet->isFavoritedBy(auth()->user()))
                                    <form action="{{ route('favorite.destroy', $tweet->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-link p-0" style="color: red;">
                                            <i class="fas fa-heart"></i>
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('favorite.store', $tweet->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-link p-0" style="color: grey;">
                                            <i class="far fa-heart"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
