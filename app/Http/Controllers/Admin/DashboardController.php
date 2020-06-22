<?php

namespace App\Http\Controllers\Admin;

use App\Categories;
use App\Posts;
use App\User;
use App\Http\Requests;
use Carbon\Carbon;
use ZipArchive;
use Illuminate\Http\Request;

class DashboardController extends MainAdminController{

protected $verifyapiserver  =  '';

protected $server  =  '1.4';

protected $servercore  =  'latest';

protected $serverrar  =  'https://emreemir.com/';

protected $pluginsapi = '';

public function __construct(){
    parent::__construct();
}

public function index(Posts $posts, User $users){

    $rangetoday = Carbon::now()->subDays(1);

    $postunapprove = $posts->approve('no')->count();

    $todaypost = $posts->where('created_at', '>=', $rangetoday)->count();

    $todayusers = $users->where('created_at', '>=', $rangetoday)->count();

    $todaylogins = $users->where('updated_at', '>=', $rangetoday)->count();

    $listcount = $posts->byType('list')->count();

    $videocount = $posts->byType('video')->count();

    $pollcount = $posts->byType('poll')->count();

    $newscount = $posts->byType('news')->count();

    $lastunappruves =$posts->approve('no')->take('10')->latest("published_at")->get();

    $lastnews = $posts->approve('yes')->byType('news')->latest("published_at")->take('5')->get();
    $lastlists  =$posts->approve('yes')->byType('list')->latest("published_at")->take('5')->get();
    $lastvideos = $posts->approve('yes')->byType('video')->latest("published_at")->take('5')->get();
    $lastpolls = $posts->approve('yes')->byType('poll')->latest("published_at")->take('5')->get();
    $lastquizzes = $posts->approve('yes')->byType('quiz')->latest("published_at")->take('5')->get();

    $lastusers = $users->latest("created_at")->take('10')->get();


    return view('_admin.pages.index', compact(
        'todaypost',
        'todaypost',
        'postunapprove',
        'todayusers',
        'todaylogins',
        'listcount',
        'videocount',
        'pollcount',
        'newscount',
        'lastunappruves',
        'lastnews',
        'lastlists',
        'lastvideos',
        'lastquizzes',
        'lastpolls',
        'lastusers'
    ));



}

public function plugins(){
    $version=\Config::get('installer.last_version');

    $code = file_get_contents(base_path('storage/.emreemircom'), true);

    $content = file_get_contents(base_path('storage/modules.php'), true);

    $plugins = json_decode($content, true);


    if (!$plugins){
        \Session::flash('error.message', trans("admin.pluginsnotavailable"));
        return redirect(action('Admin\DashboardController@index'));
    }

    $typeos = [];
    $categories = Categories::where("main", '1')->where("disabled", '0')->orwhere("main", '2')->where("disabled", '0')->orderBy('order')->get();

        foreach($categories as $cat){
            $typeos[$cat->type] = $cat->name;

            foreach(Categories::where('type', $cat->id)->orderBy('name')->get() as $cata){
                $typeos[$cata->id] = '---- '.$cata->name;
            }

        }


    return view('_admin.pages.plugins', compact(
        'plugins',
       'updateversion',
       'typeos'
    ));
}

public function activeplugin(Request $request){
    $plugin = $request->all();

    $pluginiten = $plugin['dataitem'];
    $pluginverify = $plugin['dataverify'];





    if(\DbConfig::get('p-'.$pluginiten) == 'on'){
        $type = 'off';
        $typeq = '1';

    }else{
        $type = 'on';
        $typeq = '0';

        if($pluginverify=="on"){
            if(!$this->code($pluginiten)){
                \Session::flash('error.message', trans("admin.wecaninstallplugin"));
                $message['type']='success';
                return $message;
            }
        }
    }

                    $actite = '';
                    if($pluginiten == 'news'){
                        $actite = 'news';
                    }else if($pluginiten == 'lists'){
                        $actite = 'list';
                    }else if($pluginiten == 'polls'){
                        $actite = 'poll';
                    }else if($pluginiten == 'videos'){
                        $actite = 'video';
                    }else if($pluginiten == 'quizzes'){
                        $actite = 'quiz';
                    }

                    if($actite !== ''){
                        $catees = Categories::where("type", $actite)->first();
                        $catees->disabled = $typeq;
                        $catees->save();
                    }

    \DbConfig::store('p-'.$pluginiten, $type);

    $message['type'] = 'success';
    $message['message'] = '';
    $message['url'] = '';

    return $message;
}

public function checkupdate(){

    return '1.0';

}

public function checkcode(){

    \Session::flash('error.message', trans("admin.pluginsnotavailable"));
    return redirect(action('Admin\DashboardController@index'));

}

public function sickupdate(){

return "";

}

public function updatepurcahecheck(Request $request){

    $code = $request->all();
    $autoupload = $code['dataauto'];

    $message = [];
    $content = $this->code();

    if ($autoupload == 'on'){

        if(!$this->getr($this->serverrar.$this->checkupdate().$this->sickupdate().'.zip')){
            $message['type'] = 'error';
            $message['message'] = trans("admin.unabletoupdate");
            $message['url'] = '';
        }

        $message['type'] = 'success';
        $message['message'] = trans("admin.doneupdate").$this->checkupdate();
        $message['url'] = '';

        return $message;

    }elseif ($content){

        $message['type'] = 'success';
        $message['message'] = trans("admin.donedownload");
        $message['url'] = $this->serverrar.$this->checkupdate().$this->sickupdate().'.zip';

        return $message;

    }else{

        $message['type'] = 'error';
        $message['message'] = trans("admin.purchaseincorrect");
        $message['url'] = '';

        return $message;

    }

}

public function checkinputcodeforplugin(Request $request){
    $request = $request->all();
    $code = $request['code'];
    $dataitem = $request['dataitem'];

        $this->necodep($dataitem,$code);

        return response()->json(['type'=>'success', 'message' => trans("admin.accessok")]);

}


public function getr($zurl){
    $zip_path = base_path().'/tmp.zip';

    try {
        file_put_contents($zip_path, fopen($zurl, 'r'));
    }catch(Exception $e) {

        return false;
    }
    $zip = new ZipArchive;
    if (! $zip) {

        return false;
    }
    $zip->open("$zip_path");
    $zip->extractTo(base_path());
    $zip->close();
    unlink($zip_path);

    return true;
}

}