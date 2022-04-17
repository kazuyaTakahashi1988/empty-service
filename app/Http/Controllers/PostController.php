<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;

use App\Post;
use App\Loop;
use App\Answer;
use App\Tag;
use Carbon\Carbon;
use App\Jobs\MailJob;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $q = \Request::query();

        if(isset($q['category_id'])){

            $posts = Post::latest()->where('category_id', $q['category_id'])->paginate(5);
            $posts->load('category', 'user');
            
            return view('posts.index', [
                'posts' => $posts,
                'category_id' => $q['category_id']
            ]);

        } else {

            $posts = Post::latest()->paginate(5);
            $posts->load('category', 'user');

            return view('posts.index', [
                'posts' => $posts
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
            return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        if($request->file('image')->isValid()) {
            $post = new Post;
            // $input = $request->only($post->getFillable());
            $post->user_id = $request->user_id;
            $post->category_id = $request->category_id;
            $post->content = $request->content;
            $post->title = $request->title;

            $filename = $request->file('image')->store('public/image');

            $post->image = basename($filename);
            // php artisan storage:link　でファイル格納場所を作る

            $post->save();
            
            $strs = 'cvfbnsgssssssasd';
            // MailJob::dispatch()->delay(now()->addMinutes(2));
            MailJob::dispatch($strs)->delay(now()->addMinutes(3));
            
            $last_insert_id = $post->id;


            if( $request->file('loopimage') ){


                $loop = new Loop;
                // $input = $request->only($post->getFillable());
                $loop->post_id = $last_insert_id;
                $loop->lavel = $request->lavel;

                $loopfile = $request->file('loopimage')->store('public/image');

                $loop->image = basename($loopfile);
                // php artisan storage:link　でファイル格納場所を作る

                $loop->save();
            }
        }

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $userAuth = \Auth::user();
        $post->load('category', 'user', 'comments', 'likes', 'loops', 'answer');
        $defaultCount = count($post->likes);

        if (isset($userAuth)) {
            $defaultLiked = $post->likes->where('user_id', $userAuth->id)->first();
        } else { $defaultLiked = false; }


        // if(count($defaultLiked) == 0) {
        //     $defaultLiked == false;
        // } else {
        //     $defaultLiked == true;
        // }

        $now = new Carbon();
        $updated =  new Carbon($post->updated_at);
        $limit =  $updated->addMinutes(20);
        $timeG = $now->gte($limit);

        return view('posts.show', [
            'post' => $post,
            'userAuth' => $userAuth,
            'defaultLiked' => $defaultLiked,
            'defaultCount' => $defaultCount,
            'now' => $now,
            'limit' => $limit,
            'timeG' => $timeG
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
