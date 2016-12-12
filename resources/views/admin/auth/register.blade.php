@extends('admin.layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-offset-0 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name" class="col-md-4 control-label">Name <sup><i class="fa fa-asterisk text-danger" aria-hidden="true"></i></sup></label>

                                    <div class="col-md-8">
                                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email')? ' has-error' : '' }}">
                            <div class="row">
                                {{--<div class="col-md-6">--}}
                                    {{--<label for="username" class="col-md-4 control-label">Username <sup><i class="fa fa-asterisk text-danger" aria-hidden="true"></i></sup></label>--}}

                                    {{--<div class="col-md-8">--}}
                                        {{--<input id="username" type="username" class="form-control" name="username" value="{{ old('username') }}" required>--}}

                                        {{--@if ($errors->has('username'))--}}
                                            {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('username') }}</strong>--}}
                                    {{--</span>--}}
                                        {{--@endif--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                <div class="col-md-6">
                                    <label for="email" class="col-md-4 control-label">E-Mail Address <sup><i class="fa fa-asterisk text-danger" aria-hidden="true"></i></sup></label>

                                    <div class="col-md-8">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="password" class="col-md-4 control-label">Password <sup><i class="fa fa-asterisk text-danger" aria-hidden="true"></i></sup></label>

                                    <div class="col-md-8">
                                        <input id="password" type="password" class="form-control" name="password" required>

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="password-confirm" class="col-md-4 control-label">Confirm Password <sup><i class="fa fa-asterisk text-danger" aria-hidden="true"></i></sup></label>

                                    <div class="col-md-8">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-md-2 col-md-offset-5">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
