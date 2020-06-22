<?php
$getExt = preg_split('/./', getcong('sitelogo'), null, PREG_SPLIT_NO_EMPTY);

if($getExt != NULL):

$websitelogo = asset('assets/img/').'/'.getcong('sitelogo');

if($getExt[1] == 'png'):
$attr = getimagesize($websitelogo);
$width = $attr[0];
$height = $attr[1];
endif;

if($getExt[1] == 'svg'):
$width = 144;
$height = 50;
endif;

else:

$websitelogo = asset('assets/img/').'/logo.png';
$attr = getimagesize($websitelogo);
$width = $attr[0];
$height = $attr[1];

endif;

$fontFamily = explode(':', getcong('googlefont'));
?>
@import url("https://fonts.googleapis.com/css?family={{ getcong('googlefont') }}");

body {
    font-family: {!! $fontFamily[0] !!};
    background: {{  getcong('BodyBC') }}!important;
}

div {
    font-family: {!!  $fontFamily[0] !!};
}

input {
    font-family: {!!  $fontFamily[0] !!};
}

body.mode-boxed {
    background: {{  getcong('BodyBCBM') }}!important; 
}

header {
    background: {{ getcong('NavbarBC') }}!important;
    border-top: 3px solid {{ getcong('NavbarTBLC') }}!important;
}

.header  a{
    color: {{ getcong('NavbarLC') }}!important;
}

.header a > i{
    color: {{ getcong('NavbarLC') }}!important;
}

.header a:hover{
    color: {{ getcong('NavbarLHC') }}!important;
}

.header a:hover > i{
    color: {{ getcong('NavbarLHC') }}!important;
}

.header .create-links > a {
    background: {{ getcong('NavbarCBBC') }}!important;
    color: {{ getcong('NavbarCBFC') }}!important;
    border-color: {{ getcong('NavbarCBBC') }}!important;
}

.header .create-links > a i {
    color: {{ getcong('NavbarCBFC') }}!important;
}

.header .create-links > a:hover {
    background: {{ getcong('NavbarCBHBC') }}!important;
    color: {{ getcong('NavbarCBHFC') }}!important;
}

.header .create-links > a:hover i {
    color: {{ getcong('NavbarCBHFC') }}!important;
}

.list-count:before {
    background: {{ getcong('NavbarTBLC') }}!important;
}

img.site-logo{
    /*width: {{$width}}px;*/
    height: {{$height}}px;
}