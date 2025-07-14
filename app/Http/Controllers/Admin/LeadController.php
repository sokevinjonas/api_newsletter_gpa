<?php

namespace App\Http\Controllers\Admin;

use App\Models\Lead;
use Illuminate\Http\Request;
use App\Jobs\SendWelcomeEmailJob;
use App\Http\Controllers\Controller;

class LeadController extends Controller
{
    public function index()
    {
        $leads = Lead::latest()->paginate(20);
        return view('admin.leads.index', compact('leads'));
    }

    public function sendCampaign()
    {
        $leads = Lead::whereNull('sent_at')->get();

        foreach ($leads as $lead) {
            SendWelcomeEmailJob::dispatch($lead)->delay(now()->addMinutes(rand(1, 3)));
        }

        return redirect()->route('admin.leads')->with('success', 'Campagne lancée avec succès pour ' . $leads->count() . ' leads.');
    }
}
