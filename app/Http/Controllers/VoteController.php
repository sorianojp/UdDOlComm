<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Vote;

class VoteController extends Controller
{
    public function vote(Request $request, Post $post)
    {
        $user = auth()->user();
        $voteType = $request->input('vote');
        $existingVote = $user->votes()->where('post_id', $post->id)->first();
        if ($existingVote) {
            if ($existingVote->vote_type === $voteType) {
                $existingVote->delete();
            } else {
                $existingVote->update(['vote_type' => $voteType]);
            }
        } else {
            $user->votes()->create([
                'post_id' => $post->id,
                'vote_type' => $voteType,
            ]);
        }
        return back();
    }
}
