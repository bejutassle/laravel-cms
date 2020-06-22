<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

'facebook' => [
    'client_id' => env('FACEBOOK_KEY'),
    'client_secret' => env('FACEBOOK_SECRET'),
    'redirect' => config('app.url').env('FACEBOOK_CALLBACKURL'),
],

'twitter' => [
    'client_id' => env('TWITTER_KEY'),
    'client_secret' => env('TWITTER_SECRET'),
    'redirect' => config('app.url').env('TWITTER_CALLBACKURL'),
],

'google' => [
  'client_id'     => env('GOOGLE_KEY'),
  'client_secret' => env('GOOGLE_SECRET'),
  'redirect'      => config('app.url').env('GOOGLE_CALLBACKURL'),
],

'vkontakte' => [
  'client_id'     => env('VKONTAKTE_KEY'),
  'client_secret' => env('VKONTAKTE_SECRET'),
  'redirect'      => config('app.url').env('VKONTAKTE_CALLBACKURL'),
],

'mailgun' => [
    'domain' => env('MAILGUN_DOMAIN'),
    'secret' => env('MAILGUN_SECRET'),
],

'mandrill' => [
    'secret' => env('MANDRILL_SECRET'),
],

'ses' => [
    'key'    => env('SES_KEY'),
    'secret' => env('SES_SECRET'),
    'region' => 'us-east-1',
],

'stripe' => [
    'model'  => App\User::class,
    'key'    => env('STRIPE_KEY'),
    'secret' => env('STRIPE_SECRET'),
],

];