@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @if ($isLoggedIn)
            <div class="card shadow-sm">
                <div class="card-body">
                  <form action="{{ route('tweets.store') }}" method="POST">
                    @csrf
                    <div class="d-flex mb-2">
                        <div class="me-2">
                            @if (auth()->user()->profile_image)
                                <img src="{{ asset('images/' . auth()->user()->profile_image) }}" alt="プロフィール画像" width="50" height="50" class="rounded-circle">
                            @else
                                <img src="{{ asset('default_profile_image.png') }}" alt="デフォルトプロフィール画像" width="50" height="50" class="rounded-circle">
                            @endif
                        </div>
                        <div class="flex-grow-1">
                            <textarea name="body" class="form-control border-0 no-resize" rows="3" placeholder="What's happening?" required style="resize: none;"></textarea>
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary mt-2 rounded-pill">つぶやく</button>
                    </div>
                  </form>
                </div>
            </div>
            @endif

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
                            @if ($isLoggedIn)
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
                              @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

          <!-- ログインしていない場合、つぶやき投稿を促すメッセージを表示 -->
          @if (!$isLoggedIn)
            <div class="text-center mt-4">
                <p>ログインしてつぶやきを投稿しよう！ <a href="{{ route('login') }}">ログイン</a></p>
            </div>
          @endif
        </div>
    </div>
</div>
@endsection
