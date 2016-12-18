<?php
/**
 * Created by PhpStorm.
 * User: lenskart
 * Date: 16/12/16
 * Time: 18:24
 */

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if (!$user->is_admin) {
            return response('Unauthorized.', 401);
        }
        return $next($request);

    }
}