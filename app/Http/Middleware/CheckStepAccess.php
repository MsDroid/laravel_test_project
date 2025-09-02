<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Applicant;

class CheckStepAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user(); // assuming applicant linked with user
        $applicant =  Applicant::where('user_id', $user->id)->first();

        $completedStep = $user->application_step ?? 0; // e.g., 0 = nothing, 1 = payment, 2 = personal, etc.

        $requiredStep = match ($completedStep) {
            'payment' => 1,   // everyone with account can access payment
            'personal' => 2,  
            'education' => 2, 
            'experience' => 2,  
            'documents' => 3, // education must be done
            'submit' => 4,    // documents must be done
            'preview' => 5,   // only after submit
            default => 0,
        };

        if ($completedStep < $requiredStep) {
            return redirect()
                ->route('applicant.dashboard')
                ->with('error', 'Please complete previous steps before accessing this page.');
        }

        return $next($request);
    }
}
