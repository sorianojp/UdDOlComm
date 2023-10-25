<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('home', compact('posts'));
    }
    public function myPosts()
    {
        $myposts = Post::latest()->paginate(10);
        return view('my-posts', compact('myposts'))->with('i', (request()->input('page', 1) -1) * 10);
    }
}
