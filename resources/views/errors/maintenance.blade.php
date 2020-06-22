@extends("app")
@section('header')
<style>
    .starting{
        padding:70px 0 30px 0;
        text-align: center

    }
    .starting a{
      color:#0063dc;
    }
    .starting a:hover{
      color: #dc3144;
    }
    .title{
        font-size: 60px;
        line-height: 50px;
        font-weight:300
    }
    .thanks{
        font-size: 20px;
        line-height: 70px;
        font-weight:400;
        color:#ccc;
    }

    .modeempty-header{
        max-width:800px;
        margin:0 auto;

    }
    .modeempty-header.green{

        background-color: #efefef;

    }
    .modeempty-header i{
        font-size:80px!important;
        margin-bottom:20px;
    }
    .modeempty-header i.green{
        color: #7fbc7b!important;
    }
    .modeempty_text h4{
        margin-bottom:20px;
        font-size:26px;
    }
    .modeempty_text p{
        line-height: 20px!important;
    }
    .loginat{
        max-width:400px;
        margin:0 auto;
        padding:30px;
        text-align:left;
        background-color: #fff;
        border:1px solid #ccc;
        border-radius: 8px;
        color:#555;
        line-height:25px;
    }

    .loginat u{

        color:#222;

    }
    .loginat small{
        margin-top:10px;
        font-size:11px;
        color:#aaa;

    }
    .copyright{

        text-align: center;
        margin-top:10px;
        font-size:11px;
        color:#aaa;

    }
    </style>
@endsection

@section('content')
    <div class="content" >
        <div class="container starting">


            <br>
            <div class="clear"></div>



            <div class="modeempty-header green">
                <div class="modeempty_text">

                    <i class="fa fa-wrench blue"></i>

                    <p>
                        <b>Bakımdayız.</b>
                    </p>


                </div>
            </div>
            <div class="clear"></div>
            <br>


        </div>
    </div>
@endsection
