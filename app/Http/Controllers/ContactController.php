<?php

namespace App\Http\Controllers;

use App\Categories;
use App\Contacts;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Mail\Mailer;

class ContactController extends Controller{

    public function __construct(Mailer $mailer){
        $this->mail =$mailer;
        parent::__construct();
    }


    public function index(){
        $labels=Categories::byType('maillabel')->lists('name','id' );

        return view('_contact.contactpage', compact('labels'));
    }


    public function create(Request $request){
        $input = $request->all();

        $v = \Validator::make($input, [
            'name'      => 'required',
            'email'     => 'required|email',
            'subject'   => 'required|min:5|max:255',
            'text'      => 'required|max:1500',
            'label'     => 'required',
        ]);

        if ($v->fails()) {
            \Session::flash('error.message', $v->errors()->first());
            return redirect()->back()->withInput($input);
        }

        if(getcong('ContactCopyEmail') > ''){
            if(!isset($input['g-recaptcha-response'])){
                \Session::flash('error.message', trans('contact.yourresponseincorrect'));
                return redirect()->back()->withInput($input);
            }

            $contentVar = sprintf('https://www.google.com/recaptcha/api/siteverify?secret=1$d&response=2$d&remoteip=3$d', getcong('reCaptchaSecret'), $input['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);
            $content = curlit($contentVar);

            $res= json_decode($content, true);

            if($res['success'] == false){
                \Session::flash('error.message', trans('contact.yourresponseincorrect'));
                return redirect()->back()->withInput($input);
            }

            $this->composesubject=$input['subject'];
            $this->fromemail=$input['email'];
            $this->composeto = getcong('ContactCopyEmail') > '' ? getcong('ContactCopyEmail') : getcong('siteemail');
            $this->sitename =getcong('ContactName') > '' ? getcong('ContactName') : getcong('sitename');


            $this->mail->send('_contact.emails.mailbox', array('body' => $input['text']), function($message)
            {
                $message->sender($this->fromemail, $this->sitename);
                $message->subject($this->composesubject);
                $message->from($this->fromemail, $this->sitename);
                $message->to($this->composeto);
                $message->getSwiftMessage();
            });
        }


        $cat=Categories::byType('mailcat')->where('name_slug', 'inbox')->first();
        $newrecord= new Contacts;
        $newrecord->name=$input['name'];
        $newrecord->email=$input['email'];
        $newrecord->subject=$input['subject'];
        $newrecord->text=$input['text'];
        $newrecord->category_id=$cat->id;
        $newrecord->label_id=$input['label'];
        $newrecord->read=0;
        $newrecord->save();



        \Session::flash('success.message', trans('contact.successgot'));
        return redirect('/');
    }

}
