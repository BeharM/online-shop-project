<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsAdmin {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($user = Auth::user())
        {
            if ($user->isAdmin()){
                return $next($request);
            }
        }else{
            if ($request->ajax())
            {
                return response('Unauthorized.', 401);
            }
        }
        return redirect()->route('home')->with('error', 'You Are Unauthorized! Please Log In');
    }

}
