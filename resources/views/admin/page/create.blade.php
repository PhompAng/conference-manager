@extends('admin.home')
@section('body')
    <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data" action="{{ URL::to('/admin') }}">
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

        <div class="form-group{{ $errors->has('banner') ? " has-error":"" }}">
            <div class="row">
                <div class="col-md-12">
                    <label for="banner" class="col-md-2 control-label">Banner</label>

                    <div class="col-md-10">
                        <div class="input-group">
                            <label class="input-group-btn">
                            <span class="btn btn-primary">
                                Browse&hellip; <input type="file" id="banner" name="banner" style="display: none;">
                            </span>
                            </label>
                            <input type="text" class="form-control" readonly>
                        </div>
                        @if($errors->has('banner'))
                            <span class="help-block">
                            <strong>{{ $errors->first('banner') }}</strong>
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
@section('script')
    <script type="text/javascript">
        $(function() {
            // We can attach the `fileselect` event to all file inputs on the page
            $(document).on('change', ':file', function() {
                var input = $(this),
                    numFiles = input.get(0).files ? input.get(0).files.length : 1,
                    label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
                input.trigger('fileselect', [numFiles, label]);
            });

            // We can watch for our custom `fileselect` event like this
            $(document).ready( function() {
                $(':file').on('fileselect', function(event, numFiles, label) {
                    var input = $(this).parents('.input-group').find(':text'),
                        log = numFiles > 1 ? numFiles + ' files selected' : label;

                    if( input.length ) {
                        input.val(log);
                    } else {
                        if( log ) alert(log);
                    }

                });

            });

        });
    </script>
@endsection
