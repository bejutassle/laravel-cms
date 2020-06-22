<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class Admin{

/**
 * The Guard implementation.
 *
 * @var Guard
 */
protected $auth;

/**
 * Create a new filter instance.
 *
 * @param  Guard  $auth
 * @return void
 */
public function __construct(Guard $auth){
    $this->auth = $auth;
}


/**
 * Handle an incoming request.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  \Closure  $next
 * @return mixed
 */
public function handle($request, Closure $next){

if (!$this->auth->check() or $this->auth->user()->usertype !== 'Admin') {

    
    /*if ($request->ajax()) {
        return array('errors', trans('admin.admin_not_an_error'));
    } else {
       \Session::flash('error.message',  trans('admin.admin_permission_error'));
        return redirect(abort(404));
    }*/

        abort(404);

}

    return $next($request);
}

}