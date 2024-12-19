<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class RoleMiddleware{
    /**     * Handle an incoming request.
     *     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

public function handle(Request $request, Closure $next, ...$rolnames)
{
    if (Auth::check()){
        foreach ($rolnames as $rname) {
            //dd(Auth::user()->role, $rolnames);
            if (Auth::user()->role == $rname)
        return $next($request);            }
}else {
    return redirect()->route('login.form');
    }
    return response()->view('errors.noperm');
}}
