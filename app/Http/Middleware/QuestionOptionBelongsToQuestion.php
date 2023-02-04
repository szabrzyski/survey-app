<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class QuestionOptionBelongsToQuestion
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
        if ($request->questionOption->question_id !== $request->question->id) {
            return redirect()->route('surveysIndex')->with('alert', 'Odpowiedź nie należy do pytania.');
        }

        return $next($request);
    }
}
