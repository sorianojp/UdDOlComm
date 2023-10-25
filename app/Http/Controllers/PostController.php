<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(5);
        return view('posts.index', compact('posts'))->with('i', (request()->input('page', 1) -1) * 5);
    }
    public function create()
    {
        return view('posts.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);
        Post::create([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'user_id' => auth()->user()->id,
        ]);
        return redirect()->route('posts.index')->with('success','Posted!');
    }
    public function show(Post $post)
    {
        return view('posts.show',compact('post'));
    }
    public function edit(Post $post)
    {
        return view('posts.edit',compact('post'));
    }
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);
        $post->update($request->all());
        return redirect()->route('posts.index')->with('success','Post Edited!');
    }
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success','Deleted!');
    }

}
