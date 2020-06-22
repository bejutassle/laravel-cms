<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class LangController extends Controller{

public function __construct(){
    parent::__construct();
}

public function change($lang){

    return redirect()->back()->withCookie(cookie('lang', $lang, 95000));

}

public static function forceLanguageInit(){

// 1. get the request langugage
$url_lang = \Request::segment(1);

// 2. get Cookie langugage
$cookie_lang = Cookie::get('lang');

// 3. Get the Browser Request language
$browser_lang = substr(\Request::server('HTTP_ACCEPT_LANGUAGE'), 0, 2);

// 4. Get the default language
$default_lang = substr(getcong('sitelanguage'), 0, 2);

//Get all Languages
$languages = self::getLanguages();

// Check that Language tha request is support or not?
if( (!empty($url_lang)) && (array_key_exists($url_lang, $languages)) ):

    // Check whether the request url lang not same as remember in cookies
    if($url_lang != $cookie_lang):
        Cookie::queue('lang', $url_lang, 45000);
        //\Session::put('locale', $url_lang);
    endif;

    // Set the App Locale
    $lang = $url_lang;

// Check that has Language in Forever Cookie and is it support or not?
elseif( (!empty($cookie_lang)) && (array_key_exists($cookie_lang, $languages)) ):

    // Set App Locale
    $lang = $cookie_lang;

// Check the browser request langugae is support in app?
elseif( (!empty($browser_lang)) && (array_key_exists($browser_lang, $languages)) ):

    // Check whether the request url lang not same as remember in cookies
    if($browser_lang != $cookie_lang):
        Cookie::queue('lang', $browser_lang, 45000);
        //\Session::put('locale', $browser_lang);
    endif;

    // Set Browser Lang
    $lang = $browser_lang;

else:

    Cookie::queue('lang', $default_lang, 45000);
    //\Session::put('locale', $default_lang);

    // Default Application Setting Language
    $lang = $default_lang;

endif;

    \App::setLocale($lang);
    Carbon::setLocale($lang);


    return $lang;

}

public static function getLanguages(){


$langPath = \App::langPath();

$directories = \File::directories($langPath);

$langList = [];
foreach ($directories as $key => $value) {
    $end = basename($value);
    array_push($langList, $end);
}

//dd($langList);

$langConfig = [];
foreach ($directories as $key => $value) {
            array_push($langConfig, $value);
}

//dd($langConfig);


return array(

            'tr' => array(
            'name'      => 'Türkçe',
            'rtl'       => false,
            'wideheader'=> true,
            'code' =>'tr_TR',
            ),

            'en' => array(
            'name'      => 'English',
            'rtl'       => false,
            'wideheader'=> false,
            'code' =>'en_GB',
            ),

            'ru' => array(
            'name'      => 'Русский',
            'rtl'       => false,
            'wideheader'=> true,
            'code' =>'ru_RU',
            ),

            'it' => array(
            'name'      => 'Italiano',
            'rtl'       => false,
            'wideheader'=> false,
            'code' =>'it_IT',
            ),

            'es' => array(
            'name'      => 'Español',
            'rtl'       => false,
            'wideheader'=> true,
            'code' =>'es_ES',
            ),
);


}

}