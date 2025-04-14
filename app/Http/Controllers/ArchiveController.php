<?php

namespace App\Http\Controllers;

use App\Models\Feed;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FeedExport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Mpdf\Mpdf;

class ArchiveController extends Controller
{
    public function index()
    {
        $query = Feed::with('user.profile')
            ->where('archived', true)
            ->where('user_id', Auth::id());

        if (request('from')) {
            $query->whereDate('created_at', '>=', request('from'));
        }

        if (request('to')) {
            $query->whereDate('created_at', '<=', request('to'));
        }

        $feeds = $query->latest()->get();

        return view('archive.index', compact('feeds'));
    }

    public function exportXlsx()
    {
        return Excel::download(new FeedExport, 'feeds.xlsx');
    }

    public function exportPDF(Request $request)
    {
        $feeds = Feed::query()
            ->when($request->date, fn($q) => $q->whereDate('created_at', $request->date))
            ->where('archived', true)
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        $mpdf = new Mpdf();
        $html = view('archive.pdf', compact('feeds'))->render();
        $mpdf->WriteHTML($html);

        return $mpdf->Output('feeds.pdf', 'D');
    }
}
