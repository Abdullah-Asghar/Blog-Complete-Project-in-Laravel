<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Profile;
use app\user;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      //  $user_id = Auth::user()->id;
        $profile = DB::table('users')->join('profiles', 'user_id', '=', 'profiles.user_id')->select('users.*', 'profiles.*')->first();
        $posts = Post::all();
        return view('home', ['profile' => $profile, 'posts' => $posts]);
    }
}
