<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Community;
use App\Models\Post;
use App\Models\User;

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
            'is_private' => 'required|in:0,1',
        ]);
        Community::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'user_id' => auth()->user()->id,
            'is_private' => $request->input('is_private'),
        ]);
        return redirect()->route('communities.index')->with('success','Community Created!');
    }

    public function show(Community $community)
    {
        $user = auth()->user();
        $members = $community->members;
        $isApprovedMember = $community->members()
        ->where('user_id', $user->id)
        ->where('status', 'approved')
        ->exists();
        if ($community->user_id === $user->id || $isApprovedMember) {
            return view('communities.show', compact('community', 'members'));
        }
        else {
            return view('communities.show-public', compact('community', 'members'));
        }
    }
    public function joinCommunity(Community $community)
    {
        $user = auth()->user();
        $status = $community->is_private ? 'pending' : 'approved';
        $community->members()->attach($user, ['status' => $status]);
        $message = $community->is_private ? 'Your request is pending for approval' : 'You have successfully joined the community.';
        return back()->with('success', $message);
    }
    public function approve(Community $community, User $user)
    {
        $community->members()->updateExistingPivot($user, ['status' => 'approved']);
        return redirect()->back(); // Redirect back to the community's details page.
    }
    public function reject(Community $community, User $user)
    {
        $community->members()->updateExistingPivot($user, ['status' => 'rejected']);
        return redirect()->back(); // Redirect back to the community's details page.
    }
    public function kick(Community $community, User $user)
    {
        $community->members()->where('user_id', $user->id)->detach();
        return redirect()->back();
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
