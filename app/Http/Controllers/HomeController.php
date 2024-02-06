<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Community;

class HomeController extends Controller
{
    public function index()
    {
        $latestPosts = Post::where(function($query) {
            $query->whereHas('community', function ($query) {
                $query->where('is_private', false);
            })->orWhere(function ($query) {
                $query->doesntHave('community');
            });
        })->latest()->take(5)->get();
        $communities = Community::withCount('members')
        ->orderBy('members_count', 'desc')
        ->take(5)
        ->get();
        $posts = Post::where(function($query) {
            $query->whereHas('community', function ($query) {
                $query->where('is_private', false);
            })->orWhere(function ($query) {
                $query->doesntHave('community');
            });
        })->get();
        return view('home', compact('posts', 'latestPosts', 'communities'));
    }
    public function communities()
    {
        $communities = Community::all();
        return view('communities', compact('communities'));
    }
    public function myPosts()
    {
        $user = auth()->user();
        $myposts = $user->posts()->latest()->paginate(5);
        return view('my-posts', compact('myposts'))->with('i', (request()->input('page', 1) -1) * 5);
    }
}
