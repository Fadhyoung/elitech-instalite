<?php

namespace App\Http\Controllers;

use App\Models\Feed;

class ArchiveController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function index()
    {
        $feeds = Feed::with('user.profile')->latest()->get();
        return view('archive.index', compact('feeds'));
    }
}