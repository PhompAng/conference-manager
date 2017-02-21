@extends('home')
@section('body')
    @if(!isset($conf->camera_deadline) || \Carbon\Carbon::now()->gt(\Carbon\Carbon::parse($conf->camera_deadline)))
        <h1 class="text-center">Time Up!!</h1>
    @else
        <form id="form" action="{{ URL::route('camera_ready.store', ['url'=>$prefix, 'paper_id' => $paper->id]) }}" method="POST" enctype="multipart/form-data" role="form" class="form-horizontal">
            {{ csrf_field() }}

            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <label for="title" class="col-md-2 control-label">Title <sup><i class="fa fa-asterisk text-danger" aria-hidden="true"></i></sup></label>

                        <div class="col-md-10">
                            <input type="text" id="title" class="form-control" value="{{ $paper->title }}" disabled autofocus>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group{{ $errors->has('file') ? " has-error":"" }}">
                <div class="row">
                    <div class="col-md-12">
                        <label for="file" class="col-md-2 control-label">File <sup><i class="fa fa-asterisk text-danger" aria-hidden="true"></i></sup></label>

                        <div class="col-md-10">
                            <div class="input-group">
                                <label class="input-group-btn">
                                <span class="btn btn-primary">
                                    Browse&hellip; <input type="file" id="file" name="file" style="display: none;">
                                </span>
                                </label>
                                <input type="text" class="form-control" readonly>
                            </div>
                            <span class="help-block">
                                <strong>PDF File only</strong>
                                @if($errors->has('file'))
                                    <strong>{{ $errors->first('file') }}</strong>
                                @endif
                            </span>
                        </div>

                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-2 col-md-offset-5">
                    <button id="submit" type="submit" class="btn btn-primary">
                        Submit
                    </button>
                </div>
            </div>
        </form>
    @endif
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
