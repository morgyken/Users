@extends('layouts.app')

@section('content_title','Edit role')
@section('content_description','Edit  <u>'.$role->name.'</u>  role')

@section('content')
{!! Form::open(['route' => ['users.role.update', $role->id], 'method' => 'put']) !!}
<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1-1" data-toggle="tab">Role</a></li>
                <li class=""><a href="#tab_2-2" data-toggle="tab">Permissions</a></li>
                <li class=""><a href="#tab_3-3" data-toggle="tab">Users</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1-1">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    {!! Form::label('name', 'Role name') !!}
                                    {!! Form::text('name', old('name', $role->name), ['class' => 'form-control', 'data-slug' => 'source', 'placeholder' => trans('user::roles.form.name')]) !!}
                                    {!! $errors->first('name', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
                                    {!! Form::label('slug','Role slug') !!}
                                    {!! Form::text('slug', old('slug', $role->slug), ['class' => 'form-control slug', 'data-slug' => 'target', 'placeholder' => trans('user::roles.form.slug')]) !!}
                                    {!! $errors->first('slug', '<span class="help-block">:message</span>') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2-2">
                    @include('users::partials.permissions', ['model' => $role])
                </div><!-- /.tab-pane -->
                <div class="tab-pane" id="tab_3-3">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Users with <u>{{$role->name}}</u> role</h4>
                                <ul>
                                    <?php foreach ($role->users as $user): ?>
                                        <li>
                                            <a href="{{ route('users.edit', [$user->id]) }}">{{ $user->profile->fullname }}</a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary btn-flat">Update</button>
                    <a class="btn btn-danger pull-right btn-flat" href="{{ route('users.role.index')}}"><i class="fa fa-times"></i> Cancel</a>
                </div>
            </div><!-- /.tab-content -->
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
    <dd>Go back</dd>
</dl>
@stop
@section('scripts')
<script>
    $(document).ready(function () {
        $(document).keypressAction({
            actions: [
                {key: 'b', route: "<?= route('users.role.index') ?>"}
            ]
        });
        $('input[type="checkbox"].flat-blue, input[type="radio"].flat-blue').iCheck({
            checkboxClass: 'icheckbox_flat-blue',
            radioClass: 'iradio_flat-blue'
        });
    });
</script>
@stop
