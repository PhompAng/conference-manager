@extends('home')
@section('body')
    <form action="{{ URL::to($prefix.'/paper') }}" method="POST" role="form" class="form-horizontal">

        {{ csrf_field() }}

        <div class="form-group{{ $errors->has('title') ? ' has-error':'' }}">
            <div class="row">
                <div class="col-md-12">
                    <label for="title" class="col-md-2 control-label">Title <sup><i class="fa fa-asterisk text-danger" aria-hidden="true"></i></sup></label>

                    <div class="col-md-10">
                        <input type="text" id="title" class="form-control" name="title" value="{{ old('title') }}" required autofocus>

                        @if($errors->has('title'))
                            <span class="help-block">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group{{ $errors->has('topics') ? " has-error":"" }}">
            <div class="row">
                <div class="col-md-12">
                    <label for="topics" class="col-md-2 control-label">
                        Topics <sup><i class="fa fa-asterisk text-danger" aria-hidden="true"></i></sup>
                    </label>

                    <div class="col-md-10">
                        <select id="topics" class="form-control" name="topics[]" required multiple>
                            <option value="1">option1</option>
                            <option value="2">option2</option>
                            <option value="3">option3</option>
                        </select>
                    </div>
                    @if($errors->has('topics'))
                        <span class="help-block">
                                <strong>{{ $errors->first('topics') }}</strong>
                            </span>
                    @endif
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
                        @if($errors->has('file'))
                            <span class="help-block">
                            <strong>{{ $errors->first('file') }}</strong>
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

                $("#topics").select2();
            });

        });
    </script>
@endsection
