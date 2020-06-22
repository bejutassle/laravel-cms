<?php 
$siteAdress = 'Ahmediye Mah. İnadiye Mescidi Sok. No: 27/1 Üsküdar - İSTANBUL';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
      <title>{!! getcong('sitetitle') !!}</title>
   </head>
   <body style="margin:0;padding:0;">
      <table align="center" border="0" style="width:768px;height:100%;background-color: #393939;">
         <tr>
            <td>
               <table align="center" style="width:650px;margin:0 auto;" cellpadding="0" cellspacing="0" border="0" >
                  <tr>
                     <td height="40" style=" width: 100%;text-align: center; vertical-align: middle;">
                        <span style="font-family:'Trebuchet MS', arial, sans-serif, helvetica;color:#bfbebe;font-size:13px;">
                        {!! trans('emails.email-template-header-text', ['a-href' => 'javascript:;', 'a-style' => 'text-decoration:underline; font-weight:bold; font-family:\'Trebuchet MS\',arial,sans-serif,helvetica; color:#bfbebe; font-size:13px;'])  !!}
                        </span>
                     </td>
                  </tr>
                  <tr>
                     <td><img style="display:block;" src="{!! URL::asset('assets/img/emails/mailing-head.jpg') !!}" alt="mailing head"></td>
                  </tr>
                  <tr bgcolor="#fff" style="background-color:#fff;">
                     <td style="padding-left:20px;padding-right:20px;padding-bottom:20px;">
                        <table style="border-bottom:1px solid #ea7971;border-right:1px solid #ea7971;border-left:1px solid #ea7971;font-family:'Trebuchet MS', arial, sans-serif, helvetica;color:#838587;font-size:16px;line-height:1.5;" width="100%" cellpadding="0" cellspacing="0">
                           <tr>
                              <td style="padding:40px;"><span style="color:#393939;font-size:30px;font-weight:bold;">{!! trans('emails.email-template-content-hello') !!}</span>
                              {!! trans('emails.email-template-password-reset-content', ['a-href' => action('Auth\PasswordController@getReset', ['token' => $token]), 'a-style' => 'text-decoration:underline; font-family:\'Trebuchet MS\',arial,sans-serif,helvetica; color:#da291c; font-size:16px;'])  !!}
                              </td>
                           </tr>
                           <tr>
                              <td style="padding-left:40px;padding-right:40px;">
                                 <table width="100%"  cellpadding="0" cellspacing="0">
                                    <tr>
                                       <td height="1" bgcolor="e8ebeb" width="100%" style="font-size: 1px; line-height: 1px;">&nbsp;</td>
                                    </tr>
                                 </table>
                              </td>
                           </tr>
                           <tr>
                              <td style="padding:40px;padding-top:20px;font-size:13px;">
                              {!! trans('emails.email-template-footer-text', ['a-href' => 'javascript:;', 'a-style' => 'text-decoration:underline; font-family:\'Trebuchet MS\',arial,sans-serif,helvetica; color:#da291c; font-size:13px;'])  !!}
		 <br></td>
                           </tr>
                        </table>
                     </td>
                  </tr>
                  <tr>
                     <td height="100" style="width:100%;text-align:center; font-family:'Trebuchet MS', arial, sans-serif, helvetica; color:#bfbebe; font-size:13px;">
                        {!! $siteAdress !!}
                        <br>
                        <a style="color:#bfbebe;text-decoration:none;" href="{!! url('/') !!}" target="_blank;">{!! url('/') !!}</a>
                     </td>
                  </tr>
               </table>
            </td>
         </tr>
      </table>
   </body>
</html>