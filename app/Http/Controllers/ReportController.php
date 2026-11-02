<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function create(): View
    {
        return view('reports.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'phone' => ['required', 'string', 'max:30'],
            'address' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:2000'],
        ]);

        Report::create($validated);

        return redirect()->route('lapor.create')
            ->with('success', 'Laporan berhasil dikirim. Terima kasih atas laporannya.');
    }

    public function index(): View
    {
        $reports = Report::latest()->paginate(10);
        $summary = [
            'all' => Report::count(),
            'waiting' => Report::where('status', 'Menunggu Verifikasi')->count(),
            'processing' => Report::where('status', 'Sedang Diproses')->count(),
            'completed' => Report::where('status', 'Selesai')->count(),
        ];

        return view('reports.index', compact('reports', 'summary'));
    }

    public function updateStatus(Request $request, Report $report): RedirectResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:Menunggu Verifikasi,Sedang Diproses,Selesai'],
        ]);

        $report->update($validated);

        return back()->with('success', 'Status laporan berhasil diperbarui.');
    }

    public function officerProfile(): View
    {
        return view('reports.profile');
    }
}
