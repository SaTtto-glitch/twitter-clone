@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">{{ $user->name }}</div>
                <div class="card-body">
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

            <div class="mt-4">
                @foreach ($tweets as $tweet)
                    <div class="card mt-2 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $tweet->user->name }}</h5>
                            <p class="card-text">{{ $tweet->body }}</p>
                            <small class="text-muted">{{ $tweet->created_at->diffForHumans() }}</small>

                            @if ($tweet->isFavoritedBy(auth()->user()))
                                <form action="{{ route('favorite.destroy', $tweet->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Unfavorite</button>
                                </form>
                            @else
                                <form action="{{ route('favorite.store', $tweet->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Favorite</button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
