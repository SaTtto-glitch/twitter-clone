@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">Tweets</div>

                <div class="card-body">
                  <form action="{{ route('tweets.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <textarea name="body" class="form-control" rows="3" placeholder="What's happening?" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">Tweet</button>
                  </form>
                </div>
            </div>

            <div class="mt-4">
                @foreach ($tweets as $tweet)
                    <div class="card mt-2 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">
                              <a href="{{ route('users.show', $tweet->user->id) }}">{{ $tweet->user->name }}</a>
                            </h5>
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
