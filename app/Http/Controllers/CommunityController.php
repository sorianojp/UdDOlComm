<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Community;
use App\Models\Post;

class CommunityController extends Controller
{
    public function index()
    {
        $communities = Community::all();
        return view('communities.index', compact('communities'));
    }
    public function create()
    {
        return view('communities.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
        ]);
        Community::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'user_id' => auth()->user()->id,
        ]);
        return redirect()->route('communities.index')->with('success','Community Created!');
    }

    public function show(Community $community)
    {
        $members = $community->members;
        return view('communities.show', compact('community', 'members'));
    }
    public function joinCommunity(Community $community)
    {
        $user = auth()->user();
        if ($community->user_id === $user->id) {
            return back()->with('error', 'You cannot join the community you created.');
        }
        if ($user->communities->contains($community)) {
            return back()->with('error', 'You are already a member of this community.');
        }
        $user->communities()->attach($community);
        return back()->with('success', 'You have successfully joined the community.');
    }
    public function leaveCommunity(Community $community)
    {
        $user = auth()->user();
        if ($user->communities->contains($community)) {
            $user->communities()->detach($community);
            return back()->with('success', 'You have left the community.');
        }
        return back()->with('error', 'You are not a member of this community.');
    }

    public function communityPostCreate(Community $community)
    {
        return view('communities.communityPostCreate', compact('community'));
    }
    public function communityPostStore(Request $request, Community $community)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        $post = new Post([
            'title' => $request->input('title'),
            'body' => $request->input('body'),
        ]);

        // Associate the post with the community
        $post->community()->associate($community);
        // Associate the post with the currently authenticated user
        $post->user()->associate(auth()->user());

        $post->save();

        return redirect()->route('communities.show', $community)->with('success', 'Posted!');
    }
}
