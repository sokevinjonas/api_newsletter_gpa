<?php

namespace App\Http\Controllers\Admin;

use App\Models\Lead;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $totalLeads = Lead::count();
        $emailsSent = Lead::whereNotNull('sent_at')->count();
        $newToday = Lead::whereDate('created_at', now())->count();

        // Statistiques sur les 7 derniers jours
        $days = collect(range(6, 0))->map(function ($i) {
            return now()->subDays($i)->format('Y-m-d');
        });

        $stats = Lead::where('created_at', '>=', now()->subDays(6))
            ->get()
            ->groupBy(fn($lead) => $lead->created_at->format('Y-m-d'))
            ->map(fn($group) => $group->count());

        $labels = $days->map(fn($date) => \Carbon\Carbon::parse($date)->format('d/m'))->values();
        $data = $days->map(fn($date) => $stats[$date] ?? 0)->values();

        return view('admin.dashboard.index', compact(
            'totalLeads', 'emailsSent', 'newToday', 'labels', 'data'
        ));
    }

}
