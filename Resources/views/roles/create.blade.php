@extends('layouts.app')

@section('content_title','New Role')
@section('content_description','Create a new user group')

@section('content')
{!! Form::open(['route' => 'users.role.store', 'method' => 'post']) !!}
<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1-1" data-toggle="tab">Role Info</a></li>
                <li class=""><a href="#tab_2-2" data-toggle="tab">Permissions</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1-1">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    {!! Form::label('name', 'Role name') !!}
                                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'data-slug' => 'source', 'placeholder' => 'Role name']) !!}
                                    {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
                                    {!! Form::label('slug', 'Slug') !!}
                                    {!! Form::text('slug', old('slug'), ['class' => 'form-control slug', 'data-slug' => 'target', 'placeholder' => 'Slug']) !!}
                                    {!! $errors->first('slug', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab_2-2">
                    @include('users::partials.permissions-create')
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary btn-flat">Create</button>
                    <button class="btn btn-default btn-flat" name="button" type="reset">Clear</button>
                    <a class="btn btn-danger pull-right btn-flat" href="{{ route('users.role.index')}}"><i class="fa fa-times"></i> Cancel</a>
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
    <dd> Back to index</dd>
</dl>
@stop
@section('scripts')
<script>
    $(document).ready(function () {
        $('input[type="checkbox"].flat-blue, input[type="radio"].flat-blue').iCheck({
            checkboxClass: 'icheckbox_flat-blue',
            radioClass: 'iradio_flat-blue'
        });
        $(document).keypressAction({
            actions: [
                {key: 'b', route: "<?= route('users.role.index') ?>"}
            ]
        });
    });
</script>
@stop
