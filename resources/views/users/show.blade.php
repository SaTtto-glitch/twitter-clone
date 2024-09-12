@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-blue-500 text-white">{{ $user->name }}</div>
                <div class="card-body">
                    @auth
                        @if (auth()->user()->isFollowing($user))
                            <form action="{{ route('follow.destroy', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger px-4 py-2 rounded-md bg-red-500 text-white hover:bg-red-600">Unfollow</button>
                            </form>
                        @else
                            <form action="{{ route('follow.store', $user->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary px-4 py-2 rounded-md bg-blue-500 text-white hover:bg-blue-600">Follow</button>
                            </form>
                        @endif
                    @endauth
                </div>
            </div>

            <div class="mt-4 space-y-4">
                @foreach ($tweets as $tweet)
                    <div class="card mt-2 shadow-sm">
                        <div class="card-body">
                            <div class="flex items-center mb-2">
                                <h5 class="card-title font-bold">{{ $tweet->user->name }}</h5>
                                <small class="text-gray-500 ms-2">{{ $tweet->created_at->diffForHumans() }}</small>
                            </div>
                            <p class="card-text">{{ $tweet->body }}</p>

                            <div class="mt-2">
                                @if ($tweet->isFavoritedBy(auth()->user()))
                                    <form action="{{ route('favorite.destroy', $tweet->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger px-4 py-2 rounded-md bg-red-500 text-white hover:bg-red-600">Unfavorite</button>
                                    </form>
                                @else
                                    <form action="{{ route('favorite.store', $tweet->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        <button type="submit" class="btn btn-primary px-4 py-2 rounded-md bg-blue-500 text-white hover:bg-blue-600">Favorite</button>
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
