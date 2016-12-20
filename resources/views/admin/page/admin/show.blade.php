@extends('admin.home')
@section('body')
    <form class="form-horizontal" role="form">

        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <label for="name" class="col-md-4 control-label">Name <sup><i class="fa fa-asterisk text-danger" aria-hidden="true"></i></sup></label>

                    <div class="col-md-8">
                        <input id="name" type="text" class="form-control" name="name" value="{{ $admin->name }}" disabled>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                {{--<div class="col-md-6">--}}
                {{--<label for="username" class="col-md-4 control-label">Username <sup><i class="fa fa-asterisk text-danger" aria-hidden="true"></i></sup></label>--}}

                {{--<div class="col-md-8">--}}
                {{--<input id="username" type="username" class="form-control" name="username" value="{{ $admin->username }}" disabled>--}}

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
                        <input id="email" type="email" class="form-control" name="email" value="{{ $admin->email }}" disabled>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="row">
                <div class="col-md-6">
                    <label for="created_at" class="col-md-4 control-label">Created_at <sup><i class="fa fa-asterisk text-danger" aria-hidden="true"></i></sup></label>

                    <div class="col-md-8">
                        <input id="created_at" type="created_at" class="form-control" name="created_at" value="{{$admin->created_at}}" disabled>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for="updated_at" class="col-md-4 control-label">Updated_at <sup><i class="fa fa-asterisk text-danger" aria-hidden="true"></i></sup></label>

                    <div class="col-md-8">
                        <input id="updated_at" type="updated_at" class="form-control" name="updated_at" value="{{$admin->updated_at}}" disabled>
                    </div>
                </div>
                {{--<div class="col-md-6">--}}
                    {{--<label for="password-confirm" class="col-md-4 control-label">Confirm Password <sup><i class="fa fa-asterisk text-danger" aria-hidden="true"></i></sup></label>--}}

                    {{--<div class="col-md-8">--}}
                        {{--<input id="password-confirm" type="password" class="form-control" name="password_confirmation" disabled>--}}
                    {{--</div>--}}
                {{--</div>--}}
            </div>
        </div>


        <div class="form-group">
            <div class="col-md-2 col-md-offset-5">
                <a href="{{URL::route('admin.edit', ["id" => $admin->id])}}" class="btn btn-primary">
                    Edit
                </a>
            </div>
        </div>
    </form>
@endsection
