<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class SettingController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function index(): View
    {
        $user = Auth::user();

        return view('setting.index', [
            'user' => $user,
            'setting' => $user->setting,
        ]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'feeds_per_row' => ['required', 'integer', 'min:2', 'max:5'],
        ]);

        Setting::create([
            'user_id' => $request->user()->id,
            'feeds_per_row' => $request->feeds_per_row,
            'feed_columns' => 3,         // or another logic if needed
            'show_videos' => true,
            'show_photos' => true,
        ]);

        return redirect()->back()->with('success', 'Feeds per row created successfully!');
    }



    public function update(Request $request)
    {
        $request->validate([
            'feeds_per_row' => ['required', 'integer', 'min:2', 'max:5'],
        ]);

        Setting::updateOrCreate(
            ['user_id' => $request->user()->id],
            ['feeds_per_row' => $request->feeds_per_row]
        );

        return redirect()->back()->with('success', 'Feeds per row updated successfully!');
    }
}
