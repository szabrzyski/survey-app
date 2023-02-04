<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SurveyCanBeShown
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
        if (!$request->survey->status->visible) {
            return redirect()->route('surveysIndex')->with('alert', 'Badanie nie może zostać wyświetlone.');
        }

        return $next($request);
    }
}
