<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feed;
use Illuminate\Support\Facades\Auth;

class FeedController extends Controller
{
    // Show all feeds (like a homepage or timeline)
    public function index()
    {
        $feeds = Feed::with('user.profile')->latest()->get();
        return view('feeds.index', compact('feeds'));
    }

    // Show form to create a new feed
    public function create()
    {
        return view('feeds.create');
    }

    // Handle form submission and save to database
    public function store(Request $request)
    {
        $request->validate([
            'media' => 'required|file|mimes:jpg,jpeg,png,mp4|max:10240',
            'caption' => 'nullable|string|max:255',
        ]);

        // Save file to storage
        $mediaPath = $request->file('media')->store('uploads', 'public');

        // Create feed post
        Feed::create([
            'user_id' => Auth::id(),
            'media_path' => $mediaPath,
            'media_type' => str_contains($request->file('media')->getMimeType(), 'video') ? 'video' : 'photo',
            'caption' => $request->caption,
        ]);

        return redirect()->route('feeds.index')->with('success', 'Post created!');
    }
}

