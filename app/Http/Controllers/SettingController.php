<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class SettingController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('setting.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(request $request)
    {
        
        $request->validate([
            'columns_preference' => 'required|integer|min:2|max:5',
        ]);

        $user = $request->user();
        $user->columns_preference = $request->columns_preference;
        $user->save();

        return redirect()->back()->with('success', 'Settings updated successfully!');
    }
}
