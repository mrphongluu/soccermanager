<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>DNB-Soccer</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    <link rel="stylesheet" href="{{mix('css/app2.css')}}">

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style>
        #login{
            background-image: url("http://www.dipnot.tv/wp-content/uploads/2014/06/a033bcb4a80467446a4149e1223c034e.jpg") ;
            background-size: cover;
        }
        .login-box{
            background: rgba(0, 0, 0, 0.46);
            color: white!important;
        }
        .login-box-body{
            background: transparent;
            color: white;
            font-size: 18px;
        }
        .black{
            background: rgba(0, 0, 0, 0.46);
        }
        .option{
            width: 100%;
            height: 3em;
            line-height: 3em;
            /*font-size: 1.2em;*/
            padding-bottom: 0px;
            padding-top: 0px;
        }
        #fullname{
            text-transform: uppercase;
        }
        .busy{
            font-size: 15px;
        }
        #tick{
            padding-top: 20px;
        }
        .calendar{
            color: white;
            font-size: 25px;
        }
        #address{
            margin-left: 20px;
        }

    </style>
</head>

<body class="hold-transition login-page" id="login">
<div class="login-box">
    <form action="" id="register" data-url="{{route('register.go')}}" method="get">
        <div class="login-logo">
            <p>Xin Chào: <span  id="fullname">
                    @php
                        $name_local = gethostbyaddr($_SERVER['REMOTE_ADDR']);
                        $ip = gethostbyname($name_local);
                        if(preg_match('/^([a-z]+)/i', $name_local, $matches)){
                            echo $matches[1];
                            echo ' <input type="hidden" name="name" value="'. @$matches[1] .'" >';
                        } else {
                            $_SERVER['REMOTE_ADDR'] = '127.2.2.122';
                            echo '<input type="text" name="name" class="black text-center">';
                        }

                    @endphp</span></p>
            <a href=""><b style="color: white">ĐĂNG KÝ</b></a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <input type="hidden" name="ip" value="{{$ip}}">
            <input type="hidden" name="id_she" value="{{@$OneDetail->id}}">
            <p class="login-box-msg">
                @if(@$OneDetail->time === null)
                    <a href="javascript:void(0)" class="calendar" >Không có time</a>
                @else
                    <a href="javascript:void(0)" class="calendar">{{(date('d/m H:i',strtotime(@$OneDetail->time)))}}</a>
                @endif
                <a href="javascript:void(0)" class="calendar" id="address">{{$OneDetail->address or 'Không có lịch thi đấu'}}</a>
            <div class="row">
                <div class="col-xs-6 col-md-2"><a href="#" class="btn btn-default option yes p-y-10" at="1">Tham gia</a></div>
                <div class="hidden-xs hidden-sm col-md-8">
                    <input type="range" id="tick" list="tickmarks"  min="0" max="100" step="10">
                    <datalist id="tickmarks">
                        <option value="0"/>
                        <option value="10"/>
                        <option value="20"/>
                        <option value="30"/>
                        <option value="40"/>
                        <option value="50"/>
                        <option value="60"/>
                        <option value="70"/>
                        <option value="80"/>
                        <option value="90"/>
                        <option value="100"/>
                    </datalist>
                </div>
                <div class="col-xs-6 col-md-2"><a href="#" class="btn btn-default option no" at="2">Bận</a></div>
            </div>
            <div class="form-group">
            </div>
            <label> Độ chắc chắn:</label>
            <label class="showrage">50%</label>
            <br>
            <label>Danh sách đăng ký:</label>
            <div class="row">
                <div class="col-xs-12">
                    <ol id="list-active">
                        @foreach($Lists as $list)
                            <li class="col-xs-4 join"><div ><p>{{$list->players->name }}</p></div></li>
                        @endforeach
                    </ol>
                </div>
            </div>
            <label>Danh sách bận:</label>
            <div class="row">
                <div class="col-xs-12 ">
                    <ol id="list-in-active">
                        @foreach($ListFail as $fail)
                            <li class="col-xs-4 busy"><div ><p>{{$fail->players->name }}</p></div></li>

                        @endforeach
                    </ol>
                </div>
            </div>

            <div class="social-auth-links text-center">
            </div>
            <!-- /.social-auth-links -->

        </div>
    </form>
    <!-- /.login-box-body -->
</div>
<div class="container">
    <!-- Trigger the modal with a button -->
    <div class="modal fade" id="myModal" role="dialog ">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>

                <div style="height: 400px" id="map"></div>


            </div>

        </div>
    </div>

</div>
<!-- /.login-box -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD4Sl6BCZ3v4ghoA_ltS1RVCnjTk78J43E&libraries=places"
        async defer></script>

<script src="{{mix('js/app.js')}}"></script>

</body>
</html>


