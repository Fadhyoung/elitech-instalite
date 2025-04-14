<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Feed;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{

    public function authorize()
    {
        return true;
    }

    public function index()
    {
        $user = Auth::user();
        $feeds = Feed::where('user_id', Auth::id())->with(['comments.user'])->latest()->get();

        return view('profile.index', compact('feeds', 'user'));
    }

    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => Auth::user(),
        ]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        $user->fill($request->validated());

        if ($request->hasFile('photo_profile')) {
            $path = $request->file('photo_profile')->store('uploads', 'public');
            $user->photo_profile = $path;
        }

        $user->save();


        return Redirect::route('profile.index')->with('status', 'profile-updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function showFeedModal(Feed $feed)
    {
        $user = Auth::user();
        $feeds = Feed::where('user_id', $user->id)->latest()->get();

        return view('profile.show', [
            'feeds' => $feeds,
            'selectedFeed' => $feed,
        ]);
    }
}
