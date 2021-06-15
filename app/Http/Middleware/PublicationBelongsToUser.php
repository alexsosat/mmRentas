<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Publication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicationBelongsToUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $Publication = Publication::select('user_id')->find($request->publication->id);

        if ($Publication->user_id ==  Auth::user()->id) {
            return $next($request);
        } else {
            return abort(403, 'Unauthorized action.');
        }
    }
}
