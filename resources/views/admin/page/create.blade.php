@extends('admin.home')
@section('body')
    <form class="form-horizontal" role="form" method="post" action="{{ URL::to('/admin') }}">
        {{csrf_field()}}

        <div class="form-group{{ $errors->has('name') ? ' has-error':'' }}">
            <div class="row">
                <div class="col-md-12">
                    <label for="name" class="col-md-2 control-label">Name <sup><i class="fa fa-asterisk text-danger" aria-hidden="true"></i></sup></label>

                    <div class="col-md-10">
                        <input id="name" type="text" class="form-control" name="name" value="{{old('name')}}" required autofocus>

                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group{{ $errors->has('url') ? ' has-error':'' }}">
            <div class="row">
                <div class="col-md-12">
                    <label for="url" class="col-md-2 control-label">URL <sup><i class="fa fa-asterisk text-danger" aria-hidden="true"></i></sup></label>

                    <div class="col-md-10">
                        <div class="input-group">
                            <div class="input-group-addon">{{URL('')}}/</div>
                            <input id="url" type="text" class="form-control" name="url" value="{{old('url')}}" required>
                        </div>

                        @if ($errors->has('url'))
                            <span class="help-block">
                                <strong>{{ $errors->first('url') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-2 col-md-offset-5">
                <button type="submit" class="btn btn-primary">
                    Submit
                </button>
            </div>
        </div>
    </form>
@endsection
