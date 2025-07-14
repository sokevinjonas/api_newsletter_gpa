<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Lead;
use Illuminate\Http\Request;
use App\Jobs\SendWelcomeEmailJob;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class LeadController extends Controller
{
    public function store(Request $request) 
    {
        try {
            $validated = $request->validate([
                'email' => 'required|email|unique:leads,email',
            ], [
                'email.required' => 'L\'email est requis.',
                'email.email' => 'L\'email doit être une adresse valide.',
                'email.unique' => 'Cet email est déjà utilisé.',
            ]);

            $lead = Lead::create($validated);

            SendWelcomeEmailJob::dispatch($lead);

            return response()->json([
                'status' => 'success',
                'message' => 'Merci, email bien enregistré !',
            ], 201);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Email invalide ou déjà utilisé.',
                'errors' => $e->errors(),
            ], 422);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Une erreur est survenue. Veuillez réessayer plus tard.',
            ], 500);
        }
    }
}
