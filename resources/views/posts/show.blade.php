@extends('layouts.app')

@section('content')
<div class="card-header">Board　【 詳細ページ 】</div>


<div class="card-body">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

        <div class="card">
          <div class="card-body">
            @if(isset($userAuth->id))
                <like
                :post-id="{{ json_encode($post->id) }}"
                :user-id="{{ json_encode($userAuth->id) }}"
                :default-Liked="{{ json_encode($defaultLiked) }}"
                :default-Count="{{ json_encode($defaultCount) }}">
                </like>
            @else
                <p style="font-size: 14px; border-radius: 5px; border: 1px solid #ccc; padding: 10px; display: inline-block;"><b>お気に入り登録（ログイン後に可）</b></p>
            @endif
            <br>
            <br>
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
                <br><br><br><h5><b>サムネイル：</b></h5><img src="{{ asset('storage/image/'.$post->image) }}">
            </h5>

            <br><br><br>
            <h3 class="card-title">【 内容 】</h3>
            <p class="card-text">{{ $post->content }}</p>
          </div>
        </div><br><p><b>（回答期限は質問投稿から20分間、後、投稿者はベストアンサーを選出できます。）</b></p>


        {{-- ベストアンサー選出後---Start --}}
        @if( isset($post->answer->id) && $timeG == true )
        <div class="p-3">
            <h3 class="card-title" style="color: red"><b>★　ベストアンサー　★</b></h3>
                <div class="card">
                    <div class="card-body">
                        <p class="card-text">{{ $post->answer->comment->comment }}</p>
                        <h5 class="card-text">
                            <b>投稿者　:　</b>
                            <a href="{{ route('users.show', $post->answer->comment->user->id) }}">
                                {{ $post->answer->comment->user->name }}
                            </a>
                        </h5>
                    </div>
                </div>
        </div>
        {{-- ベストアンサー選出後---End --}}
        @endif


        @if( isset($userAuth->id) && $userAuth->id == $post->user_id && !isset($post->answer->id) && $timeG == true )
        {{-- ベストアンサー選出---Start --}}
        <div class="p-3">
            <h3 class="card-title" style="background: green; color: #fff; border-radius: 20px; padding: 10px; text-align: center; ">ベストアンサーを選んでください。</h3><br>
            @foreach($post->comments as $comment)
            
            <form action="{{ route('answers.create') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="card">
                    <div class="card-body">
                        <p class="card-text"><button type="submit" class="btn btn-primary"><b>ベストアンサーに登録する</b></button></p>
                        <p class="card-text">{{ $comment->comment }}</p>
                        <h5 class="card-text">
                            <b>投稿者　:　</b>
                            <a href="{{ route('users.show', $comment->user->id) }}">
                                {{ $comment->user->name }}
                            </a>
                        </h5>
                    </div>
                </div>
                <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                <input type="hidden" name="post_id" value="{{ $post->id }}">
                <input type="hidden" name="comment" value="{{ $comment->comment }}<">
                <input type="hidden" name="user" value="{{ $comment->user->name }}">

            </form><br>
            @endforeach
        </div>
        {{-- ベストアンサー選出後---End --}}

        @else

         <div class="p-3">
            <h3 class="card-title"><b style="color: green;">☆　コメント一覧　☆</b>&nbsp;
                @if( $timeG == false )
                    <a href="{{ route('comments.create', ['post_id' => $post->id]) }}" class="btn btn-primary">コメントする</a>
                @else
                    <br><a style="font-size: 17px;"><b>【・・・回答は締め切られました・・・】</b></a>
                @endif
            </h3>
            @foreach($post->comments as $comment)

                @if(!isset($post->answer->comment_id))
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text">{{ $comment->comment }}</p>
                            <h5 class="card-text">
                                <b>投稿者　:　</b>
                                <a href="{{ route('users.show', $comment->user->id) }}">
                                    {{ $comment->user->name }}
                                </a>
                            </h5>
                        </div>
                    </div>
                @elseif( $post->answer->comment_id !== $comment->id )
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text">{{ $comment->comment }}</p>
                            <h5 class="card-text">
                                <b>投稿者　:　</b>
                                <a href="{{ route('users.show', $comment->user->id) }}">
                                    {{ $comment->user->name }}
                                </a>
                            </h5>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        @endif

</div>
@endsection
