@extends('admin.home')
@section('body')
    <form class="form-horizontal" role="form">
        <div class="form-group{{ $errors->has('name') ? ' has-error':'' }}">
            <div class="row">
                <div class="col-md-12">
                    <label for="name" class="col-md-2 control-label">Name</label>

                    <div class="col-md-10">
                        <input id="name" type="text" class="form-control" name="name" value="{{ $conf->name }}" disabled>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group{{ $errors->has('url') ? ' has-error':'' }}">
            <div class="row">
                <div class="col-md-12">
                    <label for="url" class="col-md-2 control-label">URL</label>

                    <div class="col-md-10">
                        <div class="input-group">
                            <div class="input-group-addon">{{URL('')}}/</div>
                            <input id="url" type="text" class="form-control" name="url" value="{{ $conf->url }}" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-2 col-md-offset-5">
                <a href="{{URL::route('edit', ["id" => $conf->id])}}" class="btn btn-primary">
                    Edit
                </a>
            </div>
        </div>
    </form>
@endsection
