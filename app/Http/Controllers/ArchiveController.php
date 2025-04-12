<?php

namespace App\Http\Controllers;

use App\Models\Feed;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\FeedExport;
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
        $feeds = Feed::with('user.profile')->latest()->get();
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
            ->latest()
            ->get();

        $mpdf = new Mpdf();
        $html = view('archive.pdf', compact('feeds'))->render();
        $mpdf->WriteHTML($html);
        
        return $mpdf->Output('feeds.pdf', 'D');
    }
}
