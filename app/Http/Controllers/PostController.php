<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use App\Category;
use App\Post;
use App\Like;
use App\Comment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function post()
    {
        $categories = Category::all();
        return view('posts.post', ['categories' => $categories]);
    }

    public function addPost(Request $request)
    {
        $this->validate($request, [
            'post_title' => 'required',
            'post_body' => 'required',
            'category_id' => 'required',
            'post_image' => 'required',
        ]);
        $posts = new Post;
        $posts->post_title = $request->input('post_title');
        $posts->user_id = Auth::user()->id;
        $posts->post_body = $request->input('post_body');
        $posts->category_id = $request->input('category_id');
        // images paths code
        if (Input::hasfile('post_image')) {
            $file = Input::file('post_image');
            $file->move(
                public_path() . '/posts/',
                $file->getClientOriginalName()
            );
            $url = URL::to("/") . '/posts/' . $file->getClientOriginalName();
        }
        // till here
        $posts->post_image = $url;
        $posts->save();
        return redirect('/home')->with('response', 'Post Added Successfully');
    }
  public function view($post_id){

        $posts = Post::where('id', '=', $post_id)->get();
        $postlike = Post::find($post_id);
        $likeCtr = Like::where(['post_id' => $postlike->id])->count();

        $comments = Comment::all();
        $posts = Post::all();
        $comments = DB::table('users')
        ->join('comments', 'users.id', '=', 'comments.user_id')
        ->join('posts', 'comments.post_id', '=', 'posts.id')
        ->select('users.name', 'comments.*')
        ->where(['posts.id' => $post_id])->get();
        return view('posts.view', ['posts' => $posts, 'likeCtr' => $likeCtr, 'comments' => $comments,]);
  }

  public function like($id){
             $loggedIn_user = Auth::user()->id;
             $like_user = Like::where(['user_id' => $loggedIn_user, 'post_id' => $id])->first();
       if(empty($like_user->user_id)){
            $user_id = Auth::user()->id;
            $email = Auth::user()->email;
            $post_id = $id;
            $like = new Like;
            $like->user_id = $user_id;
            $like->email = $email;
            $like->post_id = $post_id;
            $like->save();
            return redirect("/view/{$id}");
}
else{
    return redirect("/view/{$id}");
}
  }

    public function comment(Request $request, $post_id)
    {
        $this->validate($request, [
            'comment' => 'required'
        ]);
$comment = new Comment;
$comment->comment = $request->input('comment');
$comment->user_id = Auth::user()->id;
$comment->post_id = $post_id;
$comment->save();
return redirect("/view/{$post_id}")->with('response', 'Comment added successfully');
    }
}














