@extends('layouts.app')

@section('title', '| Users')

@section('content')

<div class="col-lg-12 col-lg-offset-1">
    <div class="pull-left"><i class="fa fa-users"></i> User Administration <a href="{{ route('roles.index') }}" class="btn btn-default pull-right">Roles</a>
        <a href="{{ route('permissions.index') }}" class="btn btn-default pull-right">Permissions</a>
        <a href="{{ route('users.create') }}" class="btn btn-success pull-right" style="float:right">Add User</a>
    </div>

    <hr>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">

            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Date/Time Added</th>
                <th>User Roles</th>
                <th>Operations</th>
            </tr>
            </thead>

            <tbody>
            @foreach ($users as $user)
            <tr>

                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->created_at->format('F d, Y h:ia') }}</td>
                <td>{{  $user->roles()->pluck('name')->implode(' ') }}</td>{{-- Retrieve array of roles associated to a user and convert to string --}}
                <td>
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary pull-left" style="margin-right: 3px;">编辑</a>
                    <!--                        <a href="{{ route('users.destroy', $user->id) }}" class="btn btn-danger pull-right" style="margin-right: 3px;">删除</a>-->

                    {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id] ]) !!}
                    {!! Form::submit('删除', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}

                </td>
            </tr>
            @endforeach
            </tbody>

        </table>
    </div>

</div>

@endsection
