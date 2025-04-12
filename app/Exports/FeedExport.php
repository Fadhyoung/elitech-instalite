<?php

namespace App\Exports;

use App\Models\Feed;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class FeedExport implements FromView
{
    protected $date;

    public function __construct($date = null)
    {
        $this->date = $date;
    }

    public function view(): View
    {
        $feeds = Feed::query()
            ->when($this->date, fn($q) => $q->whereDate('created_at', $this->date))
            ->latest()
            ->get();

        return view('archive.export', compact('feeds'));
    }
}
