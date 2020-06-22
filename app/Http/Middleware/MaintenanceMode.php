<?php 
namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Routing\Middleware;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

class MaintenanceMode{


protected $auth;
protected $request;
protected $app;

public function __construct(Application $app, Request $request, Guard $auth){
    $this->app = $app;
    $this->request = $request;
    $this->auth = $auth;
}

public function handle($request, Closure $next){


$pages = array('giris', 'password', 'auth', 'kayit', 'css', 'js', 'iletisim');
$segment = $this->request->segment(1);

if( (getcong('maintenance') == 1) AND (!in_array($segment, $pages)) AND (!$this->auth->check()) || ($this->auth->user()->usertype !== 'Admin') ):
 
return response()->view('errors.maintenance');

endif;

    return $next($request);
}

}