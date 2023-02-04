<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SurveyIsApiAvailable
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->survey->status->api_available) {
            return response()->json(['Badanie nie jest dostępne.'], 404);
        }

        return $next($request);
    }
}
