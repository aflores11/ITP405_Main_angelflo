<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;
use App\Models\Configuration;

class MainenanceMode
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
        $maintenance = Configuration::where('name','=','maintenance-mode')->first();
        if($maintenance->value){
            if(Auth::check()){
                //$user = User::where('id', '=', Auth::id())->first();
                $user = Auth::user();
                $privilege = Role::where('slug', '=','admin')->first();
                if($user->role_id == $privilege->id){
                    return $next($request);
                }
            }
            abort(404, 'Website Under Maintenance.');
        }
        return $next($request);
    }
}
