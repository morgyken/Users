<?php
/**
 * Created by PhpStorm.
 * User: bravo
 * Date: 8/18/17
 * Time: 12:36 PM
 */
$clinic = get_clinics();
//dd(Auth::user()->admin);
getUserClininics();
?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Select Clinic</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{m_asset('users:css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{m_asset('users:css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{m_asset('users:css/ionicons.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{m_asset('users:css/AdminLTE.min.css')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition lockscreen">
<!-- Automatic element centering -->
<div class="lockscreen-wrapper">
    <div class="lockscreen-logo">
        <a href=""><b>{{ config('practice.name') }}</b></a>
        <h2>Select Facility</h2>
    </div>
    <!-- User name -->
    <div class="lockscreen-name">{{Auth::user()->profile->full_name}}</div>
    <!-- START LOCK SCREEN ITEM -->
    <div class="lockscreen-item">
        <!-- lockscreen image -->
        <div class="lockscreen-image">
            <img src="{{m_asset('users:icon.png')}}" width="128"/>
        </div>
        <!-- /.lockscreen-image -->
        <!-- lockscreen credentials (contains the form) -->
        {!! Form::open(['class'=>'lockscreen-credentials','route'=>'public.clinic.post']) !!}
        <div class="input-group">
            @if(!$clinic->isEmpty())
                @if(Auth::user()->admin)
                    <select name="clinic" class="form-control" required>
                        <?php foreach (get_clinics() as $key => $value): ?>
                        <option value="{{$key}}">{{$value}}</option>
                        <?php endforeach; ?>
                    </select>
                    <div class="input-group-btn">
                        <button type="submit" class="btn" autofocus>
                            Go
                        </button>
                    </div>
                @else
                    <div class="form-group has-feedback">
                        <?php if (is_array(getUserClininics())): ?>
                        <select name="clinic" class="form-control" required>
                            <?php foreach (get_clinics() as $key => $value): ?>
                            <?php if (in_array($key, getUserClininics())): ?>
                            <option value="{{$key}}">{{$value}}</option>
                            <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <?php else: ?>
                        <small>You have not been assigned to any clinics</small>
                        <?php endif; ?>
                    </div>
                    <?php if (is_array(getUserClininics())): ?>
                    <div class="input-group-btn">
                        <button type="submit" class="btn">
                            Go
                        </button>
                    </div>
                    <?php endif; ?>
                @endif
            @endif
        </div>
        </form>
        <!-- /.lockscreen credentials -->
    </div>
    <div class="text-center">
        <a href="{{ route('public.logout')  }}">Or sign in as a different user</a>
    </div>
    <div class="lockscreen-footer text-center">
        Copyright &copy; {{date("Y")}} <b>
            <a href="http://www.collabmed.com/" class="text-black">COLLABMED SOLUTIONS</a></b><br>
        All rights reserved
    </div>
</div>
<!-- /.center -->
<!-- jQuery 3 -->
<script src="{{m_asset('users:js/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{m_asset('users:js/bootstrap.min.js')}}"></script>
</body>
</html>

