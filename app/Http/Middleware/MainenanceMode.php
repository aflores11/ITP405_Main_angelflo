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
            abort(403, 'Website Under Maintenance. Please Come back Later...');
        }
        return $next($request);
    }
}
