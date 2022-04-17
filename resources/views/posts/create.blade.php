@extends('layouts.app')

@section('content')
<div class="card-header">Board【 投稿ページ 】</div>
<div class="card-body">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

        <div class="card">
          <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                {{ csrf_field() }}

              <div class="form-group">
                <label for="exampleInputEmail1"><h3>title</h3></label>
                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="title" name="title">
              </div>
              
              <div class="form-group">
                <label for="exampleFormControlFile1">Example file input</label>
                <input type="file" class="form-control-file" id="exampleFormControlFile1" name="image">
              </div>

               <div class="form-group">
                    <label for="exampleFormControlSelect1"><h5>category</h5></label>
                    <select class="form-control" id="exampleFormControlSelect1" name="category_id">
                        <option selected="">選択する</option>
                        <option value="1">book</option>
                        <option value="2">cafe</option>
                        <option value="3">travel</option>
                    </select>
                </div>

                <div class="form-group">
                  <label for="comment"><h5>Comment:</h5></label>
                  <textarea class="form-control" rows="5" id="comment" name="content"></textarea>
                </div>



{{--               <h2>Loop登録</h2>
              <div class="form-group">
                <label for="exampleInputEmail1"><h3>lavel</h3></label>
                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="title" name="lavel">
              </div>
              
              <div class="form-group">
                <label for="exampleFormControlFile1">Example file input</label>
                <input type="file" class="form-control-file" id="exampleFormControlFile1" name="loopimage">
              </div> --}}

                <input type="hidden" name="user_id" value="{{ Auth::id() }}">

              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
</div>
@endsection