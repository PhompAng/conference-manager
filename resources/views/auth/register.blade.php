@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1 col-sm-offset-0 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('title') || $errors->has('academic_position') ? ' has-error' : '' }}">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="title" class="col-md-4 control-label">Title</label>

                                    <div class="col-md-8">
                                        <label class="radio-inline">
                                            <input type="radio" name="title" value="1" required {{ old('title') == '1' ? "checked":"" }}> Dr.
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="title" value="2" required {{ old('title') == '2' ? "checked":"" }}> Mr.
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="title" value="3" required {{ old('title') == '3' ? "checked":"" }}> Ms.
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="title" value="4" required {{ old('title') == '4' ? "checked":"" }}> Mrs.
                                        </label>

                                        @if ($errors->has('title'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="academic_position" class="col-md-4 control-label">Academic Positions</label>

                                    <div class="col-md-8">
                                        <label class="radio-inline">
                                            <input type="radio" name="academic_position" value="1" required {{ old('academic_position') == '1' ? "checked":"" }}> Prof.
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="academic_position" value="2" required {{ old('academic_position') == '2' ? "checked":"" }}> Assoc. Prof.
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="academic_position" value="3" required {{ old('academic_position') == '3' ? "checked":"" }}> Asst. Prof.
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="academic_position" value="4" required {{ old('academic_position') == '4' ? "checked":"" }}> None
                                        </label>

                                        @if ($errors->has('academic_position'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('academic_position') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('name') || $errors->has('family_name') ? ' has-error' : '' }}">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="name" class="col-md-4 control-label">First (and middle) name(s)</label>

                                    <div class="col-md-8">
                                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                        @if ($errors->has('name'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="family_name" class="col-md-4 control-label">Family Name</label>

                                    <div class="col-md-8">
                                        <input id="family_name" type="text" class="form-control" name="family_name" value="{{ old('family_name') }}" required autofocus>

                                        @if ($errors->has('family_name'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('family_name') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('affiliation') || $errors->has('country') ? ' has-error' : '' }}">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="affiliation" class="col-md-4 control-label">Affiliation</label>

                                    <div class="col-md-8">
                                        <input id="affiliation" type="affiliation" class="form-control" name="affiliation" value="{{ old('affiliation') }}" required>

                                        @if ($errors->has('affiliation'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('affiliation') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="country" class="col-md-4 control-label">Country</label>

                                    <div class="col-md-8">
                                        <input id="country" type="country" class="form-control" name="country" value="{{ old('country') }}" required>

                                        @if ($errors->has('country'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('mobile') || $errors->has('fax') ? ' has-error' : '' }}">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="mobile" class="col-md-4 control-label">Mobile</label>

                                    <div class="col-md-8">
                                        <input id="mobile" type="mobile" class="form-control" name="mobile" value="{{ old('mobile') }}" required>

                                        @if ($errors->has('mobile'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('mobile') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="fax" class="col-md-4 control-label">Fax</label>

                                    <div class="col-md-8">
                                        <input id="fax" type="fax" class="form-control" name="fax" value="{{ old('fax') }}">

                                        @if ($errors->has('fax'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('fax') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') || $errors->has('username') ? ' has-error' : '' }}">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="username" class="col-md-4 control-label">Username</label>

                                    <div class="col-md-8">
                                        <input id="username" type="username" class="form-control" name="username" value="{{ old('username') }}" required>

                                        @if ($errors->has('username'))
                                            <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="email" class="col-md-4 control-label">E-Mail Address</label>

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
                                    <label for="password" class="col-md-4 control-label">Password</label>

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
                                    <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

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
