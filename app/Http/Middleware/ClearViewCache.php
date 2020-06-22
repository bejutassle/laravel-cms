<?php 
namespace App\Http\Middleware;

use Artisan;
use Closure;

class ClearViewCache{

/**
 * Handle an incoming request.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  \Closure  $next
 * @return mixed
 */
public function handle($request, Closure $next){

if ( (config('view.cache') != true) || (config('view.cache') != 1) ) {
    Artisan::call('view:clear');
}

    return $next($request);

}
    
}