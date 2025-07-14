<?php

namespace App\Jobs;

use App\Models\Lead;
use App\Mail\WelcomeLeadMail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendWelcomeEmailJob implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected Lead $lead;
    /**
     * Create a new job instance.
     */
    public function __construct(Lead $lead)
    {
        $this->lead = $lead;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::info('Envoi de mail à : ' . $this->lead->email);
        Mail::to($this->lead->email)->send(new WelcomeLeadMail($this->lead));
        // Mise à jour de la date d'envoi
        $this->lead->update(['sent_at' => now()]);
    }
}
