<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

abstract class Controller extends BaseController{

use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

public function __construct(){


    \View::share(['DB_PLUGIN_NEWS' => getcong('p-news'),
        'DB_PLUGIN_LISTS' => getcong('p-lists'),
        'DB_PLUGIN_POLLS' => getcong('p-polls'),
        'DB_PLUGIN_VIDEOS' =>  getcong('p-videos'),
        'DB_PLUGIN_QUIZS' => getcong('p-quizzes'),
        'DB_USER_LANG' => LangController::forceLanguageInit(),
        'AppLangs' => LangController::getLanguages(),
    ]);

}

}