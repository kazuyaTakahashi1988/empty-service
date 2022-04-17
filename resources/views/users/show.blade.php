@extends('layouts.app')

@section('content')
<div class="card-header">{{ $user->name }}の投稿</div>
<div class="card-body">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    @foreach($user->posts as $post)
        <div class="card">
          <div class="card-body">
            <h2 class="card-title">タイトル　:　{{ $post->title }}</h2>
            <h5 class="card-title">
                <b>カテゴリー　:　</b>
                 <a href="{{ route('posts.index', ['category_id' => $post->category_id]) }}">
                    {{ $post->category->category_name }}
                </a>
            </h5>
            <h5 class="card-title">
                <b>投稿者　:　</b>
                <a href="{{ route('users.show', $post->user_id) }}"></a>
                {{ $post->user->name }}
            </h5>
            <p class="card-text">{{ $post->content }}</p>
            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">詳細</a>
          </div>
        </div>
    @endforeach

</div>
@endsection
