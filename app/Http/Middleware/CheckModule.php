<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\DB; //responsible for DB


use Illuminate\Support\Facades\Auth; //responsible for our authentication 


use Closure;

class CheckModule
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $module = null)
    {

        //reports is special
        //instead $module id ang e pass sa middleware, '/reports' ang e pass
        //url {id} mao gamiton sa module
        if( $module == '/reports' ){
            $module = request()->id;
        }



        $user_id = Auth::id();
        //$module = 1000;
        $has_access = DB::select("SELECT udf_isUserHasAccess($user_id, $module) as result ");
        //dd($has_access[0]);
        //module not found or module found but is access equals to zero
        if( count($has_access) == 0 || $has_access[0]->result == 0 ){
           // return 'ss';
            return redirect('/403');
        }

        return $next($request);
    }
}
