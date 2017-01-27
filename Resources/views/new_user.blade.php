@extends('layouts.app')

@section('content-header')
<h1>New User</h1>
@stop

@section('footer')
<a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
<dl class="dl-horizontal">
    <dt><code>b</code></dt>
    <dd>Back</dd>
</dl>
@stop
@section('content')
{!! Form::open(['method' => 'post','route'=>'users.store']) !!}
<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1-1" data-toggle="tab">Details</a></li>
                <li class=""><a href="#tab_2-2" data-toggle="tab">Role</a></li>
                <li class=""><a href="#tab_3-3" data-toggle="tab">Permissions</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1-1">
                    <div class="box-body">
                        <div class="col-md-6">
                            <div class="form-group req {{ $errors->has('title') ? ' has-error' : '' }}">
                                {!! Form::label('title', 'Title',['class'=>'control-label col-md-4']) !!}
                                <div class="col-md-8">
                                    {!! Form::select('title',config('users.titles') ,old('title'), ['class' => 'form-control',]) !!}
                                    {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div><br><br>
                            <div class="form-group req {{ $errors->has('first_name') ? ' has-error' : '' }}">
                                {!! Form::label('name', 'First Name',['class'=>'control-label col-md-4']) !!}
                                <div class="col-md-8">
                                    {!! Form::text('first_name', old('first_name'), ['class' => 'form-control', 'placeholder' => 'First Name']) !!}
                                    {!! $errors->first('first_name', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div><br><br>
                            <div class="form-group  {{ $errors->has('middle_name') ? ' has-error' : '' }}">
                                {!! Form::label('name', 'Middle Name',['class'=>'control-label col-md-4']) !!}
                                <div class="col-md-8">
                                    {!! Form::text('middle_name', old('middle_name'), ['class' => 'form-control', 'placeholder' => 'Middle Name']) !!}
                                    {!! $errors->first('middle_name', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div><br><br>
                            <div class="form-group req {{ $errors->has('last_name') ? ' has-error' : '' }}">
                                {!! Form::label('name', 'Last Name',['class'=>'control-label col-md-4']) !!}
                                <div class="col-md-8">
                                    {!! Form::text('last_name', old('last_name'), ['class' => 'form-control', 'placeholder' => 'Last Name']) !!}
                                    {!! $errors->first('last_name', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div><br><br>

                            <div class="form-group {{ $errors->has('job') ? ' has-error' : '' }}">
                                {!! Form::label('job', 'Job Description',['class'=>'control-label col-md-4']) !!}
                                <div class="col-md-8">
                                    {!! Form::textarea('job', old('job'), ['class' => 'form-control', 'placeholder' => 'Job Description','rows'=>3]) !!}
                                    {!! $errors->first('job', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div><br><br>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group {{ $errors->has('mpdb') ? ' has-error' : '' }}">
                                {!! Form::label('mpdb', 'MPDB No',['class'=>'control-label col-md-4']) !!}
                                <div class="col-md-8">
                                    {!! Form::text('mpdb', old('mpdb'), ['class' => 'form-control', 'placeholder' => 'MPDB number']) !!}
                                    {!! $errors->first('mpdb', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div><br><br>
                            <div class="form-group req {{ $errors->has('mobile') ? ' has-error' : '' }}">
                                {!! Form::label('tel', 'Mobile',['class'=>'control-label col-md-4']) !!}
                                <div class="col-md-8">
                                    {!! Form::text('mobile', old('mobile'), ['class' => 'form-control', 'placeholder' => 'Mobile No.']) !!}
                                    {!! $errors->first('mobile', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div><br><br>
                            <div class="form-group req {{ $errors->has('email') ? ' has-error' : '' }}">
                                {!! Form::label('email', 'Email',['class'=>'control-label col-md-4']) !!}
                                <div class="col-md-8">
                                    {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => 'User email']) !!}
                                    {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div><br><br>
                            <div class="form-group req {{ $errors->has('login') ? ' has-error' : '' }}">
                                {!! Form::label('login', 'Login ID',['class'=>'control-label col-md-4']) !!}
                                <div class="col-md-8">
                                    {!! Form::text('login', old('login'), ['class' => 'form-control', 'placeholder' => 'Username','autocomplete'=>'off']) !!}
                                    {!! $errors->first('login', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div><br><br>
                            <div class="form-group req {{ $errors->has('password') ? ' has-error' : '' }}">
                                {!! Form::label('password', 'Password',['class'=>'control-label col-md-4']) !!}
                                <div class="col-md-8">
                                    {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password','autocomplete'=>'off']) !!}
                                    {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div><br><br>

                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab_2-2">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Roles</label>
                                    <select multiple="" class="form-control" name="roles[]">
                                        <?php foreach ($roles as $role): ?>
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab_3-3">
                    <div class="box-body">
                        @include('users::partials.permissions-create')
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary btn-flat">Create</button>
                    <button class="btn btn-default btn-flat" name="button" type="reset">Reset</button>
                    <a class="btn btn-danger pull-right btn-flat" href="{{ route('users.index')}}"><i class="fa fa-times"></i> {{ trans('user::button.cancel') }}</a>
                </div>
            </div>
        </div>

    </div>
</div>
{!! Form::close() !!}
@stop
@section('footer')
<a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
<dl class="dl-horizontal">
    <dt><code>b</code></dt>
    <dd>Back</dd>
</dl>
@stop
@section('scripts')
<script>
    $(document).ready(function () {
        $(document).keypressAction({
            actions: [
                {key: 'b', route: "{{route('users.index')}}"}
            ]
        });
        $('input[type="checkbox"].flat-blue, input[type="radio"].flat-blue').iCheck({
            checkboxClass: 'icheckbox_flat-blue',
            radioClass: 'iradio_flat-blue'
        });
    });
</script>
@stop
