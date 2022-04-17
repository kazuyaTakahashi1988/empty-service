@extends('layouts.app')

@section('content')
  <div class="container" style="background: #e9ecef; padding: 20px 30px; margin-bottom: 40px;">
    <h1 class="display-4"><span style="font-size: 23px; font-weight: bold;">簡易的な</span> Q & A <span style="font-size: 23px; font-weight: bold;">サイトです。</span></h1>
    <p class="lead">質問を投稿または回答しましょう！<br>
        <span style="font-size: 14px;">Login&アカ登録(Register)はページ右上のボタンから。</span><br><br>
        下記のダミーアカウントでのご利用も可能<br>
        <div style="color: red">Mail::&nbsp;&nbsp;&nbsp;&nbsp;test0@test.com<br>
        Pass::&nbsp;&nbsp;&nbsp;&nbsp;testtest0<br></div>
        ※↑Mail & Passで使われてる数字の「0」は、「１~30」に置き換えてもログイン可能です。<br><br>
        ログイン後、右上のボタンから投稿ページへと行けます。<br><br>
        <div style="color: red">※このサイトは勉強がてらに作っているサイトです。アクセスログやユーザー動向等の情報は取得・監視してないので安心ください。<br>
        （しいていうならアカ登録に使ったメアドはDBから見れてしまうので、心配ならテキトーな文字列のアドレスでご登録を。）</div></p>
  </div>
<div class="card-header">Board　【 一覧ページ 】</div>


<div class="card-body">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    @foreach($posts as $post)
        <div class="card">
          <div class="card-body">
            <h2 class="card-title">Q-タイトル　:　{{ $post->title }}</h2>
            <h5 class="card-title">
                <b>カテゴリー　:　</b>
                 <a href="{{ route('posts.index', ['category_id' => $post->category_id]) }}">
                    {{ $post->category->category_name }}
                </a>
            </h5>
            <h5 class="card-title">
                <b>投稿者　:　</b>
                <a href="{{ route('users.show', $post->user_id) }}">{{ $post->user->name }}</a>
            </h5>
            <p class="card-text">{{ $post->content }}</p>
            <a href="{{ route('posts.show', $post->id) }}" class="btn btn-primary">詳細</a>
          </div>
        </div><br>
    @endforeach

    @if(isset($category_id))
        <br>{{ $posts->appends(['category_id' => $category_id])->links() }}
    @else
        <br>{{ $posts->links() }}
    @endif

</div>
@endsection
