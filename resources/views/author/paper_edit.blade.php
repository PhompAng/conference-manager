@extends('home')
@section('body')
    @if(!isset($conf->paper_deadline) || \Carbon\Carbon::now()->gt(\Carbon\Carbon::parse($conf->paper_deadline)))
        <h1 class="text-center">Time Up!!</h1>
    @else
        <form id="form" action="{{ URL::route('paper.update', ["url"=>$prefix, "id" => $paper->id]) }}" method="POST" enctype="multipart/form-data" role="form" class="form-horizontal">

            {{ csrf_field() }}
            {{ method_field('PUT') }}

            <div class="form-group{{ $errors->has('title') ? ' has-error':'' }}">
                <div class="row">
                    <div class="col-md-12">
                        <label for="title" class="col-md-2 control-label">Title <sup><i class="fa fa-asterisk text-danger" aria-hidden="true"></i></sup></label>

                        <div class="col-md-10">
                            <input type="text" id="title" class="form-control" name="title" value="{{ $paper->title }}" required autofocus>

                            @if($errors->has('title'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group{{ $errors->has('abstract') ? ' has-error':'' }}">
                <div class="row">
                    <div class="col-md-12">
                        <label for="abstract" class="col-md-2 control-label">Abstract <sup><i class="fa fa-asterisk text-danger" aria-hidden="true"></i></sup></label>

                        <div class="col-md-10">
                            <textarea id="abstract" class="form-control" name="abstract" required>{{ $paper->abstract }}</textarea>

                            @if($errors->has('abstract'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('abstract') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group{{ $errors->has('area') ? " has-error":"" }}">
                <div class="row">
                    <div class="col-md-12">
                        <label for="area" class="col-md-2 control-label">Area <sup><i class="fa fa-asterisk text-danger" aria-hidden="true"></i></sup></label>

                        <div class="col-md-10">
                            <select id="area" class="form-control" name="area" required>
                                @foreach($conf->areas as $area)
                                    <option value="{{$area}}" {{$paper->area == $area ? "selected":""}}>{{$area}}</option>
                                @endforeach
                            </select>
                        </div>
                        @if($errors->has('area'))
                            <span class="help-block">
                            <strong>{{ $errors->first('area') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="form-group{{ $errors->has('topics') ? " has-error":"" }}">
                <div class="row">
                    <div class="col-md-12">
                        <label for="topics" class="col-md-2 control-label">
                            Keywords <sup><i class="fa fa-asterisk text-danger" aria-hidden="true"></i></sup>
                        </label>

                        <div class="col-md-10">
                            <select id="topics" class="form-control" name="topics[]" required multiple>
                                @foreach($paper->topics as $topic)
                                    <option value="{{$topic}}" selected>{{$topic}}</option>
                                @endforeach
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

            {{--@if(isset($presentation))--}}
            <div class="form-group{{ $errors->has('presentation') ? " has-error":"" }}">
                <div class="row">
                    <div class="col-md-12">
                        <label for="presentation" class="col-md-2 control-label">Presentation <sup><i class="fa fa-asterisk text-danger" aria-hidden="true"></i></sup></label>

                        <div class="col-md-10">
                            <label class="radio-inline">
                                <input type="radio" name="presentation" id="presentation1" value="1" {{$paper->presentation == 1 ? "checked":""}} required> Oral Presentation
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="presentation" id="presentation2" value="2" {{$paper->presentation == 2 ? "checked":""}} required> Poster
                            </label>
                            @if($errors->has('presentation'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('presentation') }}</strong>
                                    </span>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
            {{--@endif--}}

            <div class="form-group">
                <div class="row">
                    <div class="col-md-12">
                        <label for="authors" class="col-md-2 control-label">Authors</label>

                        <div class="col-md-10">
                            <div class="well authors">
                                @foreach($paper->authors as $author)
                                <div class="author_data">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="authors_name" class="col-md-2 control-label">Name</label>
                                                <div class="col-md-10">
                                                    <input id="authors_name" type="text" class="form-control" value="{{$author['name']}}" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="authors_affiliation" class="col-md-2 control-label">Affiliation</label>
                                                <div class="col-md-10">
                                                    <input id="authors_affiliation" type="text" class="form-control" value="{{$author['affiliation']}}" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="authors_country" class="col-md-2 control-label">Country</label>
                                                <div class="col-md-10">
                                                    <input id="authors_country" type="text" class="form-control" value="{{$author['country']}}" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="authors_email" class="col-md-2 control-label">E-mail</label>
                                                <div class="col-md-10">
                                                    <input id="authors_email" type="email" class="form-control" value="{{$author['email']}}" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-12">
                                                {{--<label for="authors_email" class="col-md-2 control-label">Co Author </label>--}}
                                                <div class="col-md-10 col-md-offset-2">
                                                    <label class="checkbox-inline">
                                                        <input type="checkbox" class="co_author" value="1" {{$author['co_author']==1?"checked":""}} disabled> Co-author
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
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

                $("#topics").select2({
                    tags: true,
                    tokenSeparators: [',', ' ']
                });
                $("#area").select2();

            });

        });
    </script>
@endsection
