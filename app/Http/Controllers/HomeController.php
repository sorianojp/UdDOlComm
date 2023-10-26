<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        $latestPosts = Post::latest()->take(5)->get();
        $posts = Post::all();
        return view('home', compact('posts', 'latestPosts'));
    }
    public function myPosts()
    {
        $user = auth()->user();
        $myposts = $user->posts()->latest()->paginate(5);
        return view('my-posts', compact('myposts'))->with('i', (request()->input('page', 1) -1) * 5);
    }
}
