<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feed;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FeedController extends Controller
{
    // Show all feeds (like a homepage or timeline)
    public function index()
    {
        $feeds = Feed::with('user.profile')->latest()->get();
        return view('feeds.index', compact('feeds'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'media_path' => 'required|file|mimes:jpg,jpeg,png,mp4,mov|max:153600',
            'caption' => 'required|string|max:255',
        ]);

        $mediaFile = $request->file('media_path');
        $mediaPath = $mediaFile->store('uploads', 'public');
        $mediaType = str_contains($mediaFile->getMimeType(), 'video') ? 'video' : 'photo';

        Feed::create([
            'user_id' => Auth::id(),
            'media_path' => $mediaPath,
            'media_type' => $mediaType,
            'archived' => false,
            'caption' => $request->caption ?? 'no caption',
        ]);

        return response()->json(['success' => true, 'message' => 'Post created!']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'media_path' => 'required|file|mimes:jpg,jpeg,png,mp4,mov|max:153600',
            'caption' => 'required|string|max:255',
        ]);

        $mediaFile = $request->file('media_path');
        $mediaPath = $mediaFile->store('uploads', 'public');

        $mediaType = str_contains($mediaFile->getMimeType(), 'video') ? 'video' : 'photo';

        Feed::create([
            'user_id' => Auth::id(),
            'media_path' => $mediaPath,
            'media_type' => $mediaType,
            'archived' => false,
            'caption' => $request->caption ?? 'no caption',
        ]);

        return redirect()->route('profile.index')->with('success', 'Post created!');
    }

    public function detail(Feed $feed)
    {
        $user = Auth::user();
        return view('feeds.detail', compact('feed', 'user'));
    }

    public function show(Feed $feed)
    {
        $user = Auth::user();

        $feed->load(['comments.user']);
        $feed->loadCount(['likes']);

        $feed->liked_by_auth = $feed->likes->contains($user);

        return response()->json($feed);
    }


    public function edit(Feed $feed)
    {
        return view('feeds.edit', compact('feed'));
    }

    public function detailFeed($feed_id)
    {

        $user = Auth::user();
        $feed = Feed::with('comments.user')->findOrFail($feed_id);

        return view('profile.index', [
            'feed' => $feed,
            'user' => $user,
        ]);
    }

    public function archive($feedId)
    {
        $feed = Feed::findOrFail($feedId);
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

    public function toggleLike(Feed $feed)
    {
        $user = Auth::user();

        if ($feed->isLikedBy($user)) {
            $feed->likes()->detach($user);
            $liked = false;
        } else {
            $feed->likes()->attach($user);
            $liked = true;
        }

        return response()->json([
            'liked' => $liked,
            'likes_count' => $feed->likes()->count(),
        ]);
    }

    public function update(Request $request, Feed $feed)
    {
        $request->validate([
            'media_path' => 'required|file|mimes:jpg,jpeg,png,mp4,mov|max:153600',
            'media_type' => 'required|string',
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
        $feed = Feed::findOrFail($id);
        $feed->delete();

        return redirect()->route('feeds.index')->with('success', 'Feed deleted successfully');
    }
}
