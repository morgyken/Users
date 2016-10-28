<?php extract($data); ?>
@extends('layouts.app')

@section('content_title','Users')
@section('content_description','View system users')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="row">
            <div class="btn-group pull-right" style="margin: 0 15px 15px 0;">
                <a href="{{ route('users.create') }}" class="btn btn-primary btn-flat" style="padding: 4px 10px;">
                    <i class="fa fa-pencil"></i> New User
                </a>
            </div>
        </div>
        <div class="box box-primary">
            <div class="box-header">
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table class="data-table table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Registered On</th>
                            <th data-sortable="false">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ empty($user->profile)?ucfirst($user->username):$user->profile->full_name}}</td>
                            <td>{{$user->username}}</td>
                            <td>{{ $user->email}}</td>
                            <td>{{ $user->created_at}}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('users.edit', [$user->id]) }}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Edit</a>
                                    <?php /* if ($user->id != $currentUser->id): ?>
                                      <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.user.user.destroy', [$user->id]) }}"><i class="fa fa-trash"></i></button>
                                      <?php endif; */ ?>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col (MAIN) -->
    </div>
</div>

<!--include('core::partials.delete-modal')-->
@stop
