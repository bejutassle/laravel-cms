<?php
/**
 * @author [Emre Emir] <[<emre@emreemir.com>]>
 * @package [Route Package]
 * @license [<https://emreemir.com/mit-licence/>] [MIT]
 */

// SSL ile bağlantı varsa HTTPS olarak protokol yönetimini gerçekleştir
Route::filter('secure', function () {
    if (! Request::secure()) {
        return Redirect::secure(
            Request::path(),
            in_array(Request::getMethod(), ['POST', 'PUT', 'DELETE']) ? 307 : 302
        );
    }
});

if(!Request::secure() && App::environment() !== 'local'):
    Route::when('*', 'secure');
endif;


    Route::get('{type}.xml', 'RssController@index');

    Route::get('{type}.json', 'RssController@json');

    Route::get('/selectlanguge/{lang}', 'LangController@change');

// Stylesheet User Page
Route::get('/css/style.css', function() {
    $content = view('_particles.style-css');
    return response($content, 200)->header('Content-Type', 'text/css');
});

//Javascript User Page
Route::get('/js/main-app.js', function() {
    $content = view('_particles.app-js');
    return response($content, 200)->header('Content-Type', 'application/javascript');
});

//Javascript Admin Page
Route::get('/js/admin-app.js', function() {
    $content = view('_admin._particles.app-js');
    return response($content, 200)->header('Content-Type', 'application/javascript');
});

/**
 * Admin Control Panel Group
 */

Route::group(['namespace' => 'Admin', 'middleware' => 'Admin', 'prefix' => 'admin'], function () {

    Route::get('reports/{type}', 'ReportsController@index');

    Route::post('updatepurcahecheck', 'DashboardController@updatepurcahecheck');

    Route::get('plugins', 'DashboardController@plugins');
    Route::post('activeteplugin', 'DashboardController@activeplugin');
    Route::post('checkinputcodeforplugin', 'DashboardController@checkinputcodeforplugin');

    Route::post('addnewcategory', 'CategoriesController@addnew');
    Route::get('categories/delete/{id}', 'CategoriesController@delete');
    Route::get('categories', 'CategoriesController@index');
    Route::get('config/{page}', 'ConfigController@index');
    Route::post('config', 'ConfigController@setconfig');

    Route::get('approvepost/{id}', 'PostsController@approvepost');
    Route::get('sendtrashpost/{id}', 'PostsController@sendtrashpost');
    Route::get('forcetrashpost/{id}', 'PostsController@forcetrashpost');
    Route::get('showhomepage/{id}', 'PostsController@showhomepage');
    Route::get('pickfeatured/{id}', 'PostsController@pickfeatured');

    Route::get('posts/{name}', 'PostsController@showcatposts');
    Route::get('features', 'PostsController@features');
    Route::get('unapprove', 'PostsController@unapprove');
    Route::get('all', 'PostsController@all');
    Route::get('news', 'PostsController@news');
    Route::get('lists', 'PostsController@lists');
    Route::get('quizzes', 'PostsController@quizzes');
    Route::get('polls', 'PostsController@polls');
    Route::get('videos', 'PostsController@videos');
    Route::get('postlist', 'PostsController@getdata');

    Route::get('users', 'UsersController@users');
    Route::get('userlist', 'UsersController@getdata');


    Route::post('pages/addnew', 'PagesController@addnew');

    Route::get('pages/edit/{id}', 'PagesController@edit');
    Route::get('pages/delete', 'PagesController@delete');
    Route::get('pages/add', 'PagesController@add');
    Route::get('pages', 'PagesController@index');


    Route::post('widgets/addwidget', 'WidgetsController@addnew');
    Route::get('widgets/delete/{id}', 'WidgetsController@delete');
    Route::get('widgets', 'WidgetsController@index');

/**
 * Mailbox Controller
 */

    Route::group(['prefix' => 'mailbox'], function () {

        Route::get('/', 'ContactController@index');
        Route::get('{type}', 'ContactController@index');

        Route::post('getmails', 'ContactController@getdata');
        Route::post('newmailsent', 'ContactController@newmailsent');
        Route::post('doaction', 'ContactController@doaction');
        Route::post('dostar', 'ContactController@dostar');
        Route::post('doimportant', 'ContactController@doimportant');
        Route::post('addcat', 'ContactController@addcat');

        Route::get('new', 'ContactController@newmail');
        Route::get('mailcatdelete/{id}', 'ContactController@mailcatdelete');
        Route::get('maillabeldelete/{id}', 'ContactController@maillabeldelete');
        Route::get('read/{id}', 'ContactController@read');

    });


/**
 * System Optimize
 */

    Route::group(['prefix' => 'clear'], function () {

        //Clear Cache facade value:
        Route::get('app-cache', function() {
            Artisan::call('cache:clear');
            return '<h1>Cache facade value cleared</h1>';
        });

        //Reoptimized class loader:
        Route::get('optimize', function() {
            Artisan::call('optimize');
            return '<h1>Reoptimized class loader</h1>';
        });

        //Clear Route cache:
        Route::get('route-cache', function() {
            Artisan::call('route:cache');
            return '<h1>Route cache cleared</h1>';
        });

        //Clear View cache:
        Route::get('view-cache', function() {
            Artisan::call('view:clear');
            return '<h1>View cache cleared</h1>';
        });

        //Clear Config cache:
        Route::get('config-cache', function() {
            Artisan::call('config:cache');
            return '<h1>Clear Config cleared</h1>';
        });

        //Clear All Application Cache:
        Route::get('all', function() {
            Artisan::call('cache:clear');
            //Artisan::call('optimize');
            //Artisan::call('route:cache');
            Artisan::call('view:clear');
            Artisan::call('config:cache');
            Artisan::call('assets:purge');
            return '<h1>Cache all value cleared</h1>';
        });


    });

});

/**
 * Auth Controller
 */

    Route::group(['namespace' => 'Auth'], function () {

    Route::get('auth/social/{type}', 'AuthController@socialConnectRedirect');
    Route::get('auth/social/{type}/callback', 'AuthController@handleSocialCallback');

    Route::get('giris', 'AuthController@login');
    Route::get('kayit', 'AuthController@register');
    Route::get('cikis', 'AuthController@logout');

    Route::post('giris', 'AuthController@newlogin');
    Route::post('kayit', 'AuthController@newRegister');

    Route::get('aktivasyon/{token}', 'PasswordController@getActivate');

    Route::get('password/email', 'PasswordController@getEmail');
    Route::post('password/email', 'PasswordController@postEmail');

    Route::get('password/reset/{token}', 'PasswordController@getReset');
    Route::post('password/reset', 'PasswordController@postReset');
    Route::get('password/rt', 'PasswordController@getRt');

    });


Route::get('/', 'IndexController@index');

Route::get('iletisim', 'ContactController@index');
Route::post('iletisim', 'ContactController@create');

Route::post('upload-a-image',  'UploadController@newUpload');

Route::get('addnewform',  'FormController@addnewform');

Route::get('create',  'PostsController@CreateNew');
Route::post('create',  'PostsController@CreateNewPost');

Route::get('edit/{id}',  'PostsController@CreateEdit');
Route::post('edit/{id}',  'PostsController@CreateEditPost');
Route::get('delete/{id}',  'PostsController@sendtrashpost');

Route::get('news', 'PagesController@posttype');
Route::get('lists', 'PagesController@posttype');
Route::get('polls', 'PagesController@posttype');
Route::get('quizzes', 'PagesController@posttype');
Route::get('videos', 'PagesController@posttype');
Route::get('search',  'PagesController@search');

Route::get('tag/{tag}',  'PagesController@showtag');
Route::get('s/{page}',  'PagesController@showpage');

Route::post('uye/{userslug}/ayarlar', 'UsersController@updatesettings');
Route::post('uye/{userslug}/follow', 'UsersController@follow');
Route::get('uye/{userslug}/ayarlar', 'UsersController@settings');
Route::get('uye/{userslug}/takip-edilen', 'UsersController@following');
Route::get('uye/{userslug}/takipciler', 'UsersController@followers');
Route::get('uye/{userslug}/akis', 'UsersController@followfeed');
Route::get('uye/{userslug}/haberler', 'UsersController@news');
Route::get('uye/{userslug}/listeler', 'UsersController@lists');
Route::get('uye/{userslug}/testler', 'UsersController@quizzes');
Route::get('uye/{userslug}/videolar', 'UsersController@videos');
Route::get('uye/{userslug}/anketler', 'UsersController@polls');
Route::get('uye/{userslug}/taslaklar', 'UsersController@draftposts');
Route::get('uye/{userslug}/silinenler', 'UsersController@deletedposts');
Route::get('uye/{userslug}', 'UsersController@index');


Route::post('{catname}/{postname}/newvote', 'PollController@VoteANewPoll');
Route::post('{catname}/{postname}/vote', 'PollController@VoteAPoll');
Route::post('{catname}/{postname}/reaction', 'PollController@VoteReaction');
Route::post('shared/{postid}', 'PollController@shared');

Route::get('{catname}/{slug}', 'PostsController@index');
Route::get('{catname}', 'PagesController@showCategory');
Route::get('k/{parent}/{catname}', 'PagesController@showChildCategory');