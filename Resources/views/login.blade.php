<?php
$clinic = get_clinics();
?>
@extends('layouts.account')

@section('title')
    Login | @parent
@stop

@section('content')
    <div class="login-logo">
        <a href="{{ url('/') }}">{{ config('practice.name') }}</a>
        <img src="{{m_asset('core:img/logo.png')}}" width="360x"/>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Sign in to start your session</p>
        @include('flash::message')

        {!! Form::open(['route' => 'public.login.post']) !!}
        <div class="form-group has-feedback {{ $errors->has('username') ? ' has-error' : '' }}">
            <input type="text" class="form-control" autofocus
                   name="username" placeholder="Username" value="{{ old('username')}}">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            {!! $errors->first('username', '<span class="help-block">:message</span>') !!}
        </div>
        <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
            <input type="password" class="form-control"
                   name="password" placeholder="Password" value="{{ old('password')}}">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
        </div>
        <div class="row">
            <div class="col-xs-8">
                <div class="checkbox icheck">
                    <label>
                        <input type="checkbox"> Remember me
                    </label>
                </div>
            </div>
            <div class="col-xs-4">
                <button type="submit" class="btn btn-primary btn-block btn-flat"><i class="fa fa-sign-in"></i> Login
                </button>
            </div>
        </div>
        </form>

        <a href="{{ route('public.reset')}}" id="resetter">Forgot password?</a><br>
        <script>
            $(function () {
                $('#resetter').click(function (e) {
                    e.preventDefault();
                    swal({
                        title: 'Forgot Password',
                        type: 'info',
                        html:
                        'Email the System Administrator with your  name, role and username at ' +
                        '<strong>{{mconfig('users.users.admin_contact.email')}}</strong> or ' +
                        ' call <strong>{{mconfig('users.users.admin_contact.phone')}}</strong>  ',
                        showCloseButton: true,
//                    showCancelButton: true,
                        focusConfirm: false,
                        confirmButtonText:
                            'Okay, Got it.',
                        confirmButtonAriaLabel: 'Sawa',
                        cancelButtonText:
                            '<i class="fa fa-thumbs-down"></i>',
                        cancelButtonAriaLabel: 'Thumbs down',
                    });
                });

            });
        </script>
        @if (mconfig('user.users.allow_user_registration'))
            <a href="{{ route('public.register')}}" class="text-center">Register</a>
        @endif
    </div>
@stop
