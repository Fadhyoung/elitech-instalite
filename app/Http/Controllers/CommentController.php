<?php

// In CommentController.php
namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Feed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
            'feed_id' => 'required|exists:feeds,id',
        ]);

        $comment = Comment::create([
            'user_id' => Auth::id(),
            'feed_id' => $request->feed_id,
            'comment' => $request->comment,
        ]);

        $comment->load('user'); // in case you're showing user info too

        return response()->json([
            'success' => true,
            'comment' => $comment
        ]);
    }

    public function destroy(Comment $comment)
    {
        if ($comment->user_id !== Auth::id()) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $comment->delete();

        return response()->json(['success' => true]);
    }
}
