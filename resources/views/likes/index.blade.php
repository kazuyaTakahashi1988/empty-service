@extends('layouts.app')

@section('content')

<div class="card-header">{{ $userAuth->name }}のお気に入り一覧</div>


<div class="card-body">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    @foreach($likes as $like)
        <div class="card">
          <div class="card-body">
            <h2 class="card-title">タイトル　:　{{ $like->post->title }}</h2>
            <h5 class="card-title">
                <b>カテゴリー　:　</b>
                <a href="{{ route('posts.index', ['category_id' => $like->post->category->category_id]) }}">{{ $like->post->category->category_name }}</a>
            </h5>
            <p class="card-text">{{ $like->post->content }}</p>
            <a href="{{ route('posts.show', $like->post->id) }}" class="btn btn-primary">詳細</a>
          </div>
        </div>
    @endforeach

</div>
@endsection
