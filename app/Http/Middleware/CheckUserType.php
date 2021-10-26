<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$types)
    {
         //$user=Auth::user();
         $user=$request->user();

         /*if($user->type !='admin')
         {
             abort(403,'You are not Admin');
         }*/
 
         if(! in_array($user->type,$types) )
         {
            Auth::logout($user);
             abort(403,'You are not Admin');
             
             
         }
 
         return $next($request);
 
         

    }

     
}
