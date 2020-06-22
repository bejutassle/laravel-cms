<?php
use App\Pages;
use App\Categories;
use App\Posts;
use App\User;
use Terbium\DbConfig\Facade as DbConfig;

if (! function_exists('makepreview')) {

    function makepreview($img, $type = NULL, $folder){

        if($type !== NULL){
            $type="-$type.jpg";
        }

        if($img == NULL or $img == ''){
            $img="default_holder";
        }elseif(substr($img,0,6) == 'https:' || substr($img,0,5) == 'http:'){

            $pos=strpos($img, "amazon");
            if ($pos !== false)
            {
                return url($img.$type);
            }

            return $img;
        }

        if(env('APP_FILESYSTEM') == true):
        return awsurl().'upload/media/'.$folder.'/'.$img.$type;
        else:
        return url('/upload/media/'.$folder.'/'.$img.$type);
        endif;
    }
}

if (! function_exists('getcong')) {

    function getcong($key){
        try {
            $get =  DbConfig::get($key);
        } catch (\Exception $e) {

            return '';
        }

        return $get;
    }
}

if (! function_exists('curlit')) {


    function curlit($site){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $site);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $site = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if($httpCode == 404) {
            return false;
        }
        return $site;
    }

}


if (! function_exists('reactionvoteuserget')) {

    function reactionvoteuserget($post, $type){

        if(!\Auth::check() and getcong('sitevoting') == '1'){
           return ' href='.action('AuthController@login').' rel="get:Loginform"';

        }else{

                if($post->reactions()->currentUserHasVoteOnPost($post->id)->count() < 1){
                    return 'class="postable" data-method="POST" data-target="reactions" ';
                }else{
                    return ' class=off  href="javascript:" off:';
                }
        }


    }

}


if (! function_exists('makeposturl')) {


    function makeposturl($post){
        $type =  getcong('siteposturl');

        if($type=="" or $type==NULL or $type==1 or $type==2){

            $postuffl=$post->slug;

            if($type==2){
               $postuffl= $post->id;
            }

            $category = Categories::where("id", $post->category_id)->first();
            if($category){
                $cat = Categories::where("id", $category->type)->first();
                return '/'.$cat->posturl_slug.'/'.$postuffl;
            }else{
                return '/post/'.$postuffl;
            }

        }elseif($type==3){
           return '/'.$post->user->username_slug.'/'.$post->slug;

        }elseif($type==4){
            return '/'.$post->user->username_slug.'/'.$post->id;
        }


    }

}



if (! function_exists('getposturl')) {


    function getposturl($secone, $sectwo){
        $type =  getcong('siteposturl');

        if($type==1){
           return Posts::where('slug', $sectwo)->first();

        }elseif($type==2){
           return Posts::where('id', $sectwo)->first();

        }elseif($type==3){
            $usera=User::findByUsernameOrFail($secone);
            return Posts::where('user_id', $usera->id)->where('slug', $sectwo)->first();

        }elseif($type==4){
            $usera=User::findByUsernameOrFail($secone);
            return Posts::where('user_id', $usera->id)->where('id', $sectwo)->first();
        }


    }

}

if (! function_exists('rop')) {

    function rop($secone){
        if ($secone==$_SERVER['HTTP_HOST']){;
           return true;
        }else{
           return false;
        }
    }

}

if (! function_exists('awsurl')) {

    function awsurl(){
        $region="";
        if(env("S3_REGION") != "us-east-1"){
            $region=env("S3_REGION").'.';
        }

        return 'https://s3-'.$region.'amazonaws.com/'.env("S3_BUCKET").'/';

    }

}

if (! function_exists('spoiler')) {

function spoiler($text){


$replaces = array(
    'inönü stadı' => 'Vodafone Arena', 
    'inönü stadyumu' => 'Vodafone Arena',
    );

$keys = array_map(function ($item) {
    return $item; 
},
array_keys($replaces)
);

$trans = array_combine($keys, $replaces);

$asd = preg_replace('/(.*?)/', '$1 $2"', $trans);
//var_dump($asd);

$result = strtr($text, $trans);

return $result;


}

}

if (! function_exists('active_state_url')) {

function active_state_url($url, $segment = 3){
    $url = parse_url($url);
    $url = explode('/', $url['path']); 
    $url = $url[$segment];

    return $url;

}

}

if (! function_exists('is_localhost')) {

function is_localhost() {

    $whitelist = array(
        '127.0.0.1',
        '::1'
        );

    if(in_array($_SERVER['REMOTE_ADDR'], $whitelist)):
        return true;
    else:
        return false;
    endif;

}

}

if (! function_exists('is_ssl')) {

function is_ssl() {
    if ( isset($_SERVER['HTTPS']) ) {
        if ( 'on' == strtolower($_SERVER['HTTPS']) )
            return true;
        if ( '1' == $_SERVER['HTTPS'] )
            return true;
    } elseif ( isset($_SERVER['SERVER_PORT']) && ( '443' == $_SERVER['SERVER_PORT'] ) ) {
        return true;
    }
    return false;
}

}

if(! function_exists('text_shorten')){

function text_shorten($text, $num){

return htmlspecialchars(str_limit($text, $num), ENT_COMPAT, 'UTF-8');

}

}


if(! function_exists('lang_to_json')){

function lang_to_json($array = NULL, $arrName = array()){

$setName = "'".$arrName['title']."' : ";

if(!empty($arrName['order']) == true):
$arrTitle = (!empty($arrName)) ? $setName : '';
$last = '';
else:
$arrTitle = (!empty($arrName)) ? $arrName['title'].' = ' : '';
$last = ';';
endif;

$lang = array();
foreach ($array as $key => $value) {
    $lang[$key] = $value;
}

$jsonData = json_encode($lang, JSON_UNESCAPED_UNICODE);

echo $arrTitle.$jsonData.$last;

}

if(! function_exists('utf_ucfirst')){

function utf_ucfirst($metin){

$k_uzunluk = mb_strlen($metin, 'UTF-8');
$ilkKarakter= mb_substr($metin, 0, 1, 'UTF-8');
$kalan = mb_substr($metin, 1, $k_uzunluk-1, 'UTF-8');
$b = array('I', 'İ');
$k = array('ı', 'i');
$kalan = str_replace($b, $k, $kalan);

    return mb_strtoupper($ilkKarakter, 'UTF-8').mb_strtolower($kalan, 'UTF-8');
}

}

if(! function_exists('utf_ucwords')){

function utf_ucwords($metin){

$lower_arr = array('I'=>'ı', 'i'=>'İ');
$metin = strtr($metin, $lower_arr);
return mb_convert_case($metin, MB_CASE_TITLE, 'UTF-8');

}

}


if(! function_exists('make_path')){

function make_path($dirpath, $mode = 0777) {
    return is_dir($dirpath) || @mkdir($dirpath, $mode, true);
}

}


if(! function_exists('slug_valid')){

    function slug_valid($type = 'post', $slug, $bracket = '-'){
        $slug = str_slug($slug, $bracket);
        switch ($type) {
        case 'post':
        if(Posts::where('slug', $slug)->count() == 1){
            $count = Posts::where('slug', 'LIKE', '%'.$slug.'-%')->count();

        if($count > 0):
            $count = $count+2;
            $result = $slug.$bracket.$count;
        else:
            $count = $count+2;
            $result = $slug.$bracket.$count;
        endif;

        }else{
            $result = $slug;
        }
            break;
        case 'page':
        if(Pages::where('slug', $slug)->count() == 1){
            $count = Pages::where('slug', 'LIKE', '%'.$slug.'-%')->count();

        if($count > 0):
            $count = $count+2;
            $result = $slug.$bracket.$count;
        else:
            $count = $count+2;
            $result = $slug.$bracket.$count;
        endif;

        }else{
            $result = $slug;
        }
            break;
        default:
            $result = $slug;
        }

        return $result;

    }

}


if(! function_exists('pjax_redirect')){
function pjax_redirect($url, $status = 302) {
        if (isset($_SERVER['HTTP_X_PJAX'])) {
            header('X-PJAX-URL: '.$url, true);
            exit();
        }
        header('Location: ' . $url, true, $status);
        exit();
    }
}

}