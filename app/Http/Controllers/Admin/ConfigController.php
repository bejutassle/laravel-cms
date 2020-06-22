<?php 

namespace App\Http\Controllers\Admin;

use App\Settings;
use Illuminate\Http\Request;
use App\Http\Requests;
use Intervention\Image\Facades\Image;
use Illuminate\Contracts\Filesystem\Filesystem;

class ConfigController extends MainAdminController{

public function __construct(){
    parent::__construct();
}


public function index($page){

    return view('_admin.pages.config', compact('page'));
}

public function setconfig(Request $request){

$input = $request->all();
$sitelogo   = $request->file('sitelogo');
$footerlogo = $request->file('footerlogo');
$favicon    = $request->file('favicon');
$rules = [];

if($input['redirect'] == 'common'){

    $rules['sitename'] = 'required:sitename';
    $rules['sitelanguage'] = 'required:sitelanguage|min:5|max:5';

    if(!empty($sitelogo)):
    $rules['sitelogo'] = 'mimes:svg,png';
    endif;

    if(!empty($footerlogo)):
    $rules['footerlogo'] = 'mimes:svg,png';
    endif;

    if(!empty($favicon)):
    $rules['favicon'] = 'mimes:png,ico';
    endif;

}elseif($input['redirect'] == 'layout'){

    $rules['NavbarBC'] = 'required:color';

}elseif($input['redirect'] == 'storage'){

    if($input['app_filesystem'] == 's3'){

    $rules['s3_key'] = 'required';
    $rules['s3_secret'] = 'required';
    $rules['s3_bucket'] = 'required';
    $rules['s3_region'] = 'required';

    }

}elseif($input['redirect'] == 'mail'){

    $rules['mail_host'] = 'required';

}else{

}

    $validation = \Validator::make($input, $rules);
    $errors =  json_decode($validation->errors());

$envF = array();

if(isset($input['twitterapp'])){
    $envF['TWITTER_KEY'] = $input['twitterapp'];
}
if(isset($input['twitterappsecret'])){
    $envF['TWITTER_SECRET'] = $input['twitterappsecret'];
}
if(isset($input['facebookapp'])){
    $envF['FACEBOOK_KEY'] = $input['facebookapp'];
}
if(isset($input['facebookappsecret'])){
    $envF['FACEBOOK_SECRET'] = $input['facebookappsecret'];
}
if(isset($input['googleapp'])){
    $envF['GOOGLE_KEY'] = $input['googleapp'];
}
if(isset($input['googleappsecret'])){
    $envF['GOOGLE_SECRET'] = $input['googleappsecret'];
}

if(isset($input['sitelanguage'])){
    $defLang = explode('_', $input['sitelanguage']);
    $envF['DEFAULT_LANG'] = $defLang[0];
}

if(isset($input['app_filesystem'])){
    $envF['APP_FILESYSTEM'] = $input['app_filesystem'];
}

if(isset($input['s3_key'])){
    $envF['S3_KEY'] = $input['s3_key'];
}

if(isset($input['s3_secret'])){
    $envF['S3_SECRET'] = $input['s3_secret'];
}

if(isset($input['s3_region'])){
    $envF['S3_REGION'] = $input['s3_region'];
}

if(isset($input['s3_bucket'])){
    $envF['S3_BUCKET'] = $input['s3_bucket'];
}

if(isset($input['mail_driver'])){
    $envF['MAIL_DRIVER'] = $input['mail_driver'];
}

if(isset($input['mail_host'])){
    $envF['MAIL_HOST'] = $input['mail_host'];
}

if(isset($input['mail_port'])){
    $envF['MAIL_PORT'] = $input['mail_port'];
}

if(isset($input['mail_username'])){
    $envF['MAIL_USERNAME'] = $input['mail_username'];
}

if(isset($input['mail_password'])){
    $envF['MAIL_PASSWORD'] = $input['mail_password'];
}

if(isset($input['mail_encryption'])){
    $envF['MAIL_ENCRYPTION'] = $input['mail_encryption'];
}

if($validation->passes()){

if(isset($input['HomeColSec1Type1'])){
    $this->deletebuilderconfigs('HomeColSec1Type1');
}
if(isset($input['HomeColSec2Type1'])){
    $this->deletebuilderconfigs('HomeColSec2Type1');
}
if(isset($input['HomeColSec3Type1'])){
    $this->deletebuilderconfigs('HomeColSec3Type1');
}

if($footerlogo){
    $footerlogo->move(public_path().'/assets/img', 'flogo.png');
}

if($sitelogo){

    $sitelogotype = \File::mimeType($sitelogo);

if($sitelogotype == 'image/svg+xml'){
    $sitelogoext = 'svg';
}

if($sitelogotype == 'image/svg'){
    $sitelogoext = 'svg';
}

if($sitelogotype == 'image/png'){
    $sitelogoext = 'png';
}

    $sitelogoname = 'logo.'.$sitelogoext;
    $sitelogo->move(public_path().'/assets/img', 'logo.'.$sitelogoext);
    $input['sitelogo'] = $sitelogoname;

}

if($favicon){
    $favicon->move(public_path().'/assets/img', 'favicon.png');
}

        $this->changeEnv($envF);

        //\Session::flash('success.message', trans('admin.ChangesSaved'));

        foreach($input as $key => $int){
            if($key !== 'redirect' && $key !== '/admin/config' && $key !== '_token'){
                    \DbConfig::store($key, $int);
            }
        }

}

    if ($validation->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => $errors,
                ], 422);
    }else{
                return response()->json([
                    'success' => true,
                    'message' => trans('admin.ChangesSaved'),
                    'url' => action('Admin\ConfigController@index', ['page' => $input['redirect']]),
                ], 200); 
    }

}

public function deletebuilderconfigs($type){

$settings = Settings::where('key', 'LIKE', "%$type%")->get();

if(isset($settings)){
    foreach($settings as $tp){
        $tp->delete();
    }
}

}

protected function changeEnv($data = array()){
if(count($data) > 0){

// Read .env-file
$env = file_get_contents(base_path() . '/.env');

// Split string on every " " and write into array
$env = preg_split('/\s+/', $env);;

// Loop through given data
foreach((array)$data as $key => $value){

    // Loop through .env-data
    foreach($env as $env_key => $env_value){

        // Turn the value into an array and stop after the first split
        // So it's not possible to split e.g. the App-Key by accident
        $entry = explode("=", $env_value, 2);

        // Check, if new key fits the actual .env-key
        if($entry[0] == $key){
            // If yes, overwrite it with the new one
            $env[$env_key] = $key . "=" . $value;
        } else {
            // If not, keep the old one
            $env[$env_key] = $env_value;
        }
    }
}

// Turn the array back to an String
$env = implode("\n", $env);

// And overwrite the .env with the new data
file_put_contents(base_path() . '/.env', $env);

return true;
} else {
return false;
}

}

}