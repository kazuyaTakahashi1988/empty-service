@extends('layouts.app')

@section('content')
<div class="card-header">Board【 こちらの回答をベストアンサーに登録しますか？ 】</div>
<div class="card-body">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

        <div class="card">
          <div class="card-body">
            <form action="{{ route('answers.store') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="card">
                    <div class="card-body">
                        <p class="card-text"><button type="submit" class="btn btn-primary"><b>登録します</b></button></p>
                        <p class="card-text">{{ $comment }}</p>
                        <h5 class="card-text">
                            <b>投稿者　:　</b>
                            <a>
                                {{ $user }}
                            </a>
                        </h5>
                    </div>
                </div>
                <input type="hidden" name="comment_id" value="{{ $comment_id }}">
                <input type="hidden" name="post_id" value="{{ $post_id }}">

            </form><br>
          </div>
        </div>
</div>
@endsection
