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
            'media_path' => 'required|file|mimes:jpg,jpeg,png,mp4|max:20480',
            'caption' => 'nullable|string|max:255',
        ]);

        // Store the media file
        $mediaFile = $request->file('media_path');
        $mediaPath = $mediaFile->store('uploads', 'public');

        // Determine media type
        $mediaType = str_contains($mediaFile->getMimeType(), 'video') ? 'video' : 'photo';

        // Create the feed
        Feed::create([
            'user_id' => Auth::id(),
            'media_path' => $mediaPath,
            'media_type' => $mediaType,
            'archived' => false,
            'caption' => $request->caption ?? 'no caption',
        ]);

        return redirect()->route('profile.index')->with('success', 'Post created!');
    }

    public function show(Feed $feed)
    {
        return view('feeds.show', compact('feed'));
    }

    public function edit(Feed $feed)
    {
        return view('feeds.edit', compact('feed'));
    }

    public function detailFeed($feed_id)
    {
        // Fetch the feed by its ID
        $feed = Feed::findOrFail($feed_id); // Assuming your Feed model exists
        $user = Auth::user();

        return view('profile.index', [
            'feed' => $feed,
            'user' => $user,
        ]);
    }

    public function archive($feedId)
    {
        // Fetch the feed by its ID
        $feed = Feed::findOrFail($feedId); // Assuming your Feed model exists
        $user = Auth::user();
        if ($feed->user_id !== $user->id) {
            abort(403);
        }

        $feed->archived = true;
        $feed->save();

        $feeds = Feed::where('user_id', Auth::id())->latest()->get();
        return response()->json([
            'message' => 'Feed archived successfully',
            'feeds' => $feeds
        ]);
    }

    public function unarchive($feedId)
    {
        $feed = Feed::findOrFail($feedId);
        $user = Auth::user();

        if ($feed->user_id !== $user->id) {
            abort(403);
        }

        $feed->archived = false;
        $feed->save();

        $feeds = Feed::where('user_id', Auth::id())->latest()->get();
        return response()->json([
            'message' => 'Feed has been unarchived.',
            'feeds' => $feeds
        ]);
    }

    public function update(Request $request, Feed $feed)
    {
        $request->validate([
            'media_path' => 'nullable|file|mimes:jpg,jpeg,png,mp4,mov,avi,webm|max:20480',
            'media_type' => 'nullable|string',
            'caption' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('media_path')) {
            $path = $request->file('media_path')->store('uploads', 'public');
            $feed->media_path = $path;

            $mime = $request->file('media_path')->getMimeType();
            $feed->media_type = str_contains($mime, 'video') ? 'video' : 'photo';
        }

        $feed->caption = $request->caption;

        $feed->save();

        return redirect()->route('feeds.index')->with('success', 'Feed updated!');
    }

    public function destroy($id)
    {
        $feed = Feed::findOrFail($id);  // Find the feed by ID
        $feed->delete();  // Delete the feed from the database

        return redirect()->route('feeds.index')->with('success', 'Feed deleted successfully');
    }
}
