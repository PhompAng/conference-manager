@extends('admin.home')
@section('body')
    <form class="form-horizontal" role="form" method="post" action="{{ URL::to('/admin', ["id" => $conf->id]) }}">
        {{csrf_field()}}
        {{method_field('PUT')}}
        <div class="form-group{{ $errors->has('name') ? ' has-error':'' }}">
            <div class="row">
                <div class="col-md-12">
                    <label for="name" class="col-md-2 control-label">Name</label>

                    <div class="col-md-10">
                        <input id="name" type="text" class="form-control" name="name" value="{{ $conf->name }}" required autofocus>
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
                    <label for="url" class="col-md-2 control-label">URL</label>

                    <div class="col-md-10">
                        <div class="input-group">
                            <div class="input-group-addon">{{URL('')}}/</div>
                            <input id="url" type="text" class="form-control" name="url" value="{{ $conf->url }}" required>
                            @if ($errors->has('url'))
                                <span class="help-block">
                                <strong>{{ $errors->first('url') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group{{ $errors->has('open') || $errors->has('close') || $errors->has('paper_deadline') || $errors->has('acceptance') || $errors->has('camera_deadline') || $errors->has('pre_regis') ? ' has-error':'' }}">
            <div class="row">
                <div class="col-md-12">
                    <label class="col-md-2 control-label">Schedule</label>

                    <div class="col-md-10">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr class="info">
                                <th>No.</th>
                                <th>Schedule</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>Open Conference</td>
                                <td>
                                    <input class="form-control" type="datetime-local" name="open" value="{{$conf->open}}" step=1 required>

                                    @if ($errors->has('open'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('open') }}</strong>
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Paper submission deadline</td>
                                <td>
                                    <input class="form-control" type="datetime-local" name="paper_deadline" value="{{$conf->paper_deadline}}"  step=1 required>
                                    @if ($errors->has('paper_deadline'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('paper_deadline') }}</strong>
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Acceptance announcement</td>
                                <td>
                                    <input class="form-control" type="datetime-local" name="acceptance" value="{{$conf->acceptance}}" step=1 required>
                                    @if ($errors->has('acceptance'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('acceptance') }}</strong>
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Camera-ready submission deadline</td>
                                <td>
                                    <input class="form-control" type="datetime-local" name="camera_deadline" value="{{$conf->camera_deadline}}" step=1 required>
                                    @if ($errors->has('camera_deadline'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('camera_deadline') }}</strong>
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Pre-registration deadline</td>
                                <td>
                                    <input class="form-control" type="datetime-local" name="pre_regis" value="{{$conf->pre_regis}}" step=1 required>
                                    @if ($errors->has('pre_regis'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('pre_regis') }}</strong>
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>Close Conference</td>
                                <td>
                                    <input class="form-control" type="datetime-local" name="close" value="{{$conf->close}}" step=1 required>
                                    @if ($errors->has('close'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('close') }}</strong>
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            </tbody>
                        </table>
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
