<?php

namespace App\Http\Middleware;

use App\Model\Conference;
use Closure;
use Illuminate\Auth\Middleware\Authenticate;

class ConfAuth extends Authenticate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string[]  ...$guards
     * @return mixed
     *
     * @throws \Illuminate\Auth\AuthenticationException
     */
    public function handle($request, Closure $next, ...$guards)
    {
        $conf = Conference::where('url', $request->segment(1))->first();
        $user = \Illuminate\Support\Facades\Auth::user();
        if (empty($guards) && !is_null($user) && $user->conference_id != $conf->id) {
            \Illuminate\Support\Facades\Auth::guard()->logout();
            return redirect()->guest($request->segment(1).'/login');
        }

        $this->authenticate($guards);

        return $next($request);
    }
}
