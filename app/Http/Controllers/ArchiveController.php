<?php

namespace App\Http\Controllers;

use App\Models\Feed;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FeedExport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Mpdf\Mpdf;
use PDF;

class ArchiveController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function index()
    {
        $query = Feed::with('user.profile')
            ->where('archived', true)
            ->where('user_id', Auth::id());

        // Apply "from" date filter if provided
        if (request('from')) {
            $query->whereDate('created_at', '>=', request('from'));
        }

        // Apply "to" date filter if provided
        if (request('to')) {
            $query->whereDate('created_at', '<=', request('to'));
        }

        $feeds = $query->latest()->get();

        return view('archive.index', compact('feeds'));
    }

    // Export to XLSX
    public function exportXlsx()
    {
        return Excel::download(new FeedExport, 'feeds.xlsx');
    }

    // Export to PDF
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
