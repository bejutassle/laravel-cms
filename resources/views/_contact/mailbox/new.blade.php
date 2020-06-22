@extends('_contact.mailbox.mailapp')
@section('mailcontent')
    <style>
        blockquote{
            border-left:2px solid #333!important;
            margin-top:10px
        }

        .inoutuh{
            font-size:22px;
            height:auto
        }
        .sendmail{
            font-size:16px;
            height:auto
        }
    </style>
        <div class="box box-primary">
            <div class="overlay hide">
                <i class="fa fa-refresh fa-spin"></i>
            </div>
            <div class="box-header with-border">
                <h3 class="box-title">{!! trans('admin.compose_new_message') !!}</h3>
            </div><!-- /.box-header -->
            {!!   Form::open(array('action' => 'Admin\ContactController@newmailsent', 'method' => 'POST', 'onsubmit' => 'return false', 'enctype' => 'multipart/form-data')) !!}
            <div class="box-body">


                <div class="form-group">
                    {!! Form::text('email-to', isset($lastmail) ? $lastmail->email : '', ['id' => 'name','placeholder' => trans('admin.mail_to'), 'class' => 'form-control inoutuh']) !!}

                </div>
                <div class="form-group">
                    {!! Form::text('email-subject', isset($lastmail) ? 'RE: '.$lastmail->subject : '', ['id' => 'name','placeholder' => trans('admin.mail_subject'), 'class' => 'form-control inoutuh']) !!}

                </div>
                <div class="form-group">
                    <textarea name="email-body" id="compose-textarea" class="form-control" style="height: 400px">
                        {!!   getcong('BuzzyContactSignature') ? '<br><br><br>'.getcong('BuzzyContactSignature'): '' !!}
                        {{ isset($lastmail) ? '<blockquote><br><hr>'.$lastmail->text.'</blockquote>' : '' }}
                    </textarea>
                </div>
            </div><!-- /.box-body -->
            <div class="box-footer">
                <div class="pull-right">
                    <button class="btn btn-default sendmail" data-type="draftsave" style="margin-right:5px"><i class="fa fa-pencil" style="margin-right:5px"></i> {!! trans('admin.mail_draft') !!}</button>
                    <button type="submit" class="btn btn-primary sendmail"  data-type="sendit"><i class="fa fa-envelope-o" style="margin-right:5px"></i> {!! trans('admin.mail_send') !!}</button>
                </div>
                <a href="/admin/mailbox" class="btn btn-default"><i class="fa fa-times"></i> {!! trans('admin.mail_discard') !!}</a>
            </div><!-- /.box-footer -->
            {!! Form::close() !!}
        </div><!-- /. box -->

@endsection