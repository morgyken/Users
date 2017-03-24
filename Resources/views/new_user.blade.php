@extends('layouts.app')

@section('content-header')
<h1>New User</h1>
@stop

@section('footer')
<a data-toggle="modal" data-target="#keyboardShortcutsModal">
    <i class="fa fa-keyboard-o"></i></a> &nbsp;
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
                <!--
                <li class=""><a href="#tab_3-3" data-toggle="tab">Permissions</a></li>
                -->
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1-1">
                    <div class="box-body">
                        <div class="col-md-6">
                            <div class="form-group req {{ $errors->has('title') ? ' has-error' : '' }}">
                                {!! Form::label('title', 'Title',['class'=>'control-label col-md-4']) !!}
                                <div class="col-md-8">
                                    {!! Form::select('title',mconfig('users.users.titles') ,old('title'), ['class' => 'form-control',]) !!}
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
                            <!-- Not Active at the moment -->
                            <!--
                            <div class="form-group"><br><br>
                                {!! Form::label('job', 'User is a Supplier',['class'=>'control-label col-md-4']) !!}
                                <div class="col-md-8">
                                    <input type="checkbox" class="is_supplier" name="is_supplier">
                                    <small>
                                        <i>User is linked with a supplier firm</i>
                                    </small>
                                    {!! Form::select('supplier',get_suppliers(),null,['class'=>'suppliers form-control']) !!}
                                </div>
                            </div><br><br> 
                            -->

                            <div class="form-group">
                                {!! Form::label('job', 'External Doctor',['class'=>'control-label col-md-4']) !!}
                                <div class="col-md-8">
                                    <input type="checkbox" class="external_doctor" name="has_external_doctor">
                                    <small>
                                        <i>User is an External Doctor or Staff at partner institution</i>
                                    </small>

                                    <select class="partners form-control" name="partner">
                                        <option>Select Partner Institution</option>
                                        <?php foreach ($partners as $p): ?>
                                            <option value="{{ $p->id }}">{{ $p->name }}</option>
                                        <?php endforeach; ?>
                                    </select>
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

                            <div class="form-group req">
                                <label class="col-md-4">Roles</label>
                                <div class="col-md-8">
                                    <select multiple="" required="" class="form-control" name="roles[]">
                                        <?php foreach ($roles as $role): ?>
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!--
                <div class="tab-pane" id="tab_3-3">
                    <div class="box-body">
                        @include('users::partials.permissions-create')
                    </div>
                </div> -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary btn-flat">Create</button>
                    <button class="btn btn-default btn-flat" name="button" type="reset">Reset</button>
                    <a class="btn btn-danger pull-right btn-flat" href="{{ route('users.index')}}"><i class="fa fa-times"></i> Cancel</a>
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

        $(".suppliers").hide();
        $(".is_supplier").click(function () {
            if ($(this).is(":checked")) {
                $(".suppliers").show(300);
            } else {
                $(".suppliers").hide(200);
            }
        });

        $(".partners").hide();
        $(".external_doctor").click(function () {
            if ($(this).is(":checked")) {
                $(".partners").show(300);
            } else {
                $(".partners").hide(200);
            }
        });

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
