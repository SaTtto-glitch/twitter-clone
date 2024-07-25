@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tweets</div>

                <div class="card-body">
                    <form action="{{ route('tweets.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <textarea name="body" class="form-control" rows="3" placeholder="What's happening?"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary mt-2">Tweet</button>
                    </form>
                </div>
            </div>

            <div class="mt-4">
                @foreach ($tweets as $tweet)
                    <div class="card mt-2">
                        <div class="card-body">
                            <h5>{{ $tweet->user->name }}</h5>
                            <p>{{ $tweet->body }}</p>
                            <small>{{ $tweet->created_at->diffForHumans() }}</small>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
