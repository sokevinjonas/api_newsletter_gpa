<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Lead;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AnalyticsController extends Controller
{
    public function index()
    {
        $labels = collect(range(6, 0))->map(fn($i) => now()->subDays($i)->format('d/m'));
        $leadCounts = $labels->map(fn($date) => Lead::whereDate('created_at', Carbon::createFromFormat('d/m', $date))->count());

        $sources = Lead::select('source')->distinct()->pluck('source');
        $sourceCounts = $sources->map(fn($src) => Lead::where('source', $src)->count());

        return view('admin.analytics.index', [
            'labels' => $labels,
            'leadCounts' => $leadCounts,
            'sources' => $sources,
            'sourceCounts' => $sourceCounts,
            'growthRate' => 12.5, // calcul à faire
            'sentRate' => round(Lead::whereNotNull('sent_at')->count() / max(Lead::count(), 1) * 100, 1),
            'pendingLeads' => Lead::whereNull('sent_at')->count(),
            'mainSource' => Lead::select('source')->groupBy('source')->orderByRaw('COUNT(*) DESC')->first()?->source ?? 'Inconnu'
        ]);
    }

}
