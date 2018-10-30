@extends('layouts.default')
@section('title', '注册')

@section('content')
<div class="col-md-offset-2 col-md-8">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h5>注册</h5>
        </div>
        <div class="panel-body">
            @include('shared._errors')
            <form method="POST" action="{{ route('users.store') }}">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="name">名称：</label>
                    <input id="name" type="text" name="name" value="{{ old('name') }}" class="form-control">
                </div>
            
                <div class="form-group">
                    <label for="email">邮箱：</label>
                    <input id="email" type="text" name="email" value="{{ old('email') }}" class="form-control">
                </div>

                 <div class="form-group">
                    <label for="password">密码：</label>
                    <input id="password" type="password" name="password" class="form-control" value="{{ old('name') }}">
                </div>

                <div class="form-group">
                    <label for="password_confirmation">确认密码：</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" class="form-control" value="{{ old('password_confirmation') }}">
                </div>

                <button type="submit" class="btn btn-primary">注册</button>
            </form>
        </div>
    </div>
</div>
@stop

