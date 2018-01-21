@extends('home')
@section('body')
    <div id="content">
        <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
            @foreach($reviews as $key=>$review)
                <li role="presentation" class="{{$key==0 ? "active":""}}">
                    <a href="#{{$key++}}" aria-controls="home" role="tab" data-toggle="tab">{{$key++}}</a>
                </li>
            @endforeach
        </ul>

        @if(count($reviews) < 1)
            <div class="well">
                <h4>This paper doesn't have review.</h4>
            </div>
        @endif
        <div id="tab-contents" class="tab-content">
            @foreach($reviews as $key=>$review)
                <div class="tab-pane {{$key==0 ? "active":""}}" id="{{$key++}}">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            1. Review comments
                        </div>
                        <div class="panel-body">
                            <p>1.1 Additional Comments to authors (Strength)</p>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <textarea id="comment_str" class="form-control" rows="3" disabled>{{$review->pivot->comment_str}}</textarea>

                                    </div>
                                </div>
                            </div>

                            <p>1.2 Additional Comments to authors (Weakness)</p>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <textarea id="comment_weak" class="form-control" rows="3" disabled>{{$review->pivot->comment_weak}}</textarea>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

@endsection
