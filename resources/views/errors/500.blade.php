<!DOCTYPE html>
<html>
    <head>
        <title>{!! trans('updates.right_back') !!}</title>
        <style>
        @import  url("https://fonts.googleapis.com/css?family=Ubuntu:400,500,700&amp;subset=latin,latin-ext");
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                color: #DB3C43;
                display: table;
                font-weight: 100;
                font-family: 'Ubuntu';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 56px;
                margin-bottom: 40px;
            }
            div.title-bottom{
                font-size: 40px;
            }
            div.title-bottom > a{
                color: #DB3C43;
                text-decoration: none;
            }
            div.title-bottom > a:hover{
                color: #C43137;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">{!! trans('updates.right_back') !!}</div>
                <div class="title-bottom"><a href="mailto:emre@emreemir.com">emre@emreemir.com</a></div>
            </div>
        </div>
    </body>
</html>
