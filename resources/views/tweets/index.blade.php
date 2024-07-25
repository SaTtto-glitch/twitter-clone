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
                            <h5 class="card-title">{{ $tweet->user->name }}</h5>
                            <p class="card-text">{{ $tweet->body }}</p>
                            <small class="text-muted">{{ $tweet->created_at->diffForHumans() }}</small>

                            @if (auth()->user()->isFollowing($tweet->user))
                                <form action="{{ route('follow.destroy', $tweet->user->id) }}" method="POST" class="mt-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Unfollow</button>
                                </form>
                            @else
                                <form action="{{ route('follow.store', $tweet->user->id) }}" method="POST" class="mt-2">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Follow</button>
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
