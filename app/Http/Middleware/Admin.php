<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Notification;

class Admin
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
        
        if(Auth::check()) {
            $user = Auth::user();
            if($user->is_admin) {
                return $next($request);
            }
            
            Notification::warning(
                'Only Admins can access admin pages.' .
                'You can email ' . getenv('ADMIN_EMAIL') .
                ' to request admin access.'
            );
            return redirect()->route('site.home');
        }
    
        return redirect()->route('site.home');
    }
}

