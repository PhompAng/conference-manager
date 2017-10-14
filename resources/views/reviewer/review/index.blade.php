@extends('home')
@section('body')
    <div class="alert alert-info">
        <h4>Score rating (for each issue):</h4>
        <p>(5) Excellent, Very good (>85%), (4) Good (70-85%), (3) Fair (50-70%), (2) Moderate needed (30-50%), (1) Unacceptable, Very poor (<30%)</p>
    </div>

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
                            1. Content Rating
                        </div>
                        <div class="panel-body">
                            <p>1.1 Does this paper describe the substantial or innovative work ? <sup><i class="fa fa-asterisk text-danger" aria-hidden="true"></i></sup></p>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="radio-inline">
                                            <input type="radio" id="score[1.1]" value="5" {{$review->pivot->score['1.1'] == 5 ? "checked":""}} disabled> 5
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" id="score[1.1]" value="4" {{$review->pivot->score['1.1'] == 4 ? "checked":""}} disabled> 4
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" id="score[1.1]" value="3" {{$review->pivot->score['1.1'] == 3 ? "checked":""}} disabled> 3
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" id="score[1.1]" value="2" {{$review->pivot->score['1.1'] == 2 ? "checked":""}} disabled> 2
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" id="score[1.1]" value="1" {{$review->pivot->score['1.1'] == 1 ? "checked":""}} disabled> 1
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <p>1.2 Does the technical content of the paper fit well the scope of the Conference ? <sup><i class="fa fa-asterisk text-danger" aria-hidden="true"></i></sup></p>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="radio-inline">
                                            <input type="radio" id="score[1.2]" value="5" {{$review->pivot->score['1.2'] == 5 ? "checked":""}} disabled> 5
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" id="score[1.2]" value="4" {{$review->pivot->score['1.2'] == 4 ? "checked":""}} disabled> 4
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" id="score[1.2]" value="3" {{$review->pivot->score['1.2'] == 3 ? "checked":""}} disabled> 3
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" id="score[1.2]" value="2" {{$review->pivot->score['1.2'] == 2 ? "checked":""}} disabled> 2
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" id="score[1.2]" value="1" {{$review->pivot->score['1.2'] == 1 ? "checked":""}} disabled> 1
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            2. Presentation
                        </div>
                        <div class="panel-body">
                            <p>2.1 How clear does the abstract describe the work ? <sup><i class="fa fa-asterisk text-danger" aria-hidden="true"></i></sup></p>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="radio-inline">
                                            <input type="radio" id="score[2.1]" value="5" {{$review->pivot->score['2.1'] == 5 ? "checked":""}} disabled> 5
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" id="score[2.1]" value="4" {{$review->pivot->score['2.1'] == 4 ? "checked":""}} disabled> 4
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" id="score[2.1]" value="3" {{$review->pivot->score['2.1'] == 3 ? "checked":""}} disabled> 3
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" id="score[2.1]" value="2" {{$review->pivot->score['2.1'] == 2 ? "checked":""}} disabled> 2
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" id="score[2.1]" value="1" {{$review->pivot->score['2.1'] == 1 ? "checked":""}} disabled> 1
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <p>2.2 Does the literature review provide enough background and adequate reference cite, for a general reader to understand the subject ? <sup><i class="fa fa-asterisk text-danger" aria-hidden="true"></i></sup></p>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="radio-inline">
                                            <input type="radio" id="score[2.2]" value="5" {{$review->pivot->score['2.2'] == 5 ? "checked":""}} disabled> 5
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" id="score[2.2]" value="4" {{$review->pivot->score['2.2'] == 4 ? "checked":""}} disabled> 4
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" id="score[2.2]" value="3" {{$review->pivot->score['2.2'] == 3 ? "checked":""}} disabled> 3
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" id="score[2.2]" value="2" {{$review->pivot->score['2.2'] == 2 ? "checked":""}} disabled> 2
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" id="score[2.2]" value="1" {{$review->pivot->score['2.2'] == 1 ? "checked":""}} disabled> 1
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <p>2.3 Is the theory (if any) adequately developed ? <sup><i class="fa fa-asterisk text-danger" aria-hidden="true"></i></sup></p>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="radio-inline">
                                            <input type="radio" id="score[2.3]" value="5" {{$review->pivot->score['2.3'] == 5 ? "checked":""}} disabled> 5
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" id="score[2.3]" value="4" {{$review->pivot->score['2.3'] == 4 ? "checked":""}} disabled> 4
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" id="score[2.3]" value="3" {{$review->pivot->score['2.3'] == 3 ? "checked":""}} disabled> 3
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" id="score[2.3]" value="2" {{$review->pivot->score['2.3'] == 2 ? "checked":""}} disabled> 2
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" id="score[2.3]" value="1" {{$review->pivot->score['2.3'] == 1 ? "checked":""}} disabled> 1
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <p>2.4 Are the analyses correct and clearly presented ? <sup><i class="fa fa-asterisk text-danger" aria-hidden="true"></i></sup></p>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="radio-inline">
                                            <input type="radio" id="score[2.4]" value="5" {{$review->pivot->score['2.4'] == 5 ? "checked":""}} disabled> 5
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" id="score[2.4]" value="4" {{$review->pivot->score['2.4'] == 4 ? "checked":""}} disabled> 4
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" id="score[2.4]" value="3" {{$review->pivot->score['2.4'] == 3 ? "checked":""}} disabled> 3
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" id="score[2.4]" value="2" {{$review->pivot->score['2.4'] == 2 ? "checked":""}} disabled> 2
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" id="score[2.4]" value="1" {{$review->pivot->score['2.4'] == 1 ? "checked":""}} disabled> 1
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <p>2.5 Does the writing style, text flow and paper length meet the Conference standards ? <sup><i class="fa fa-asterisk text-danger" aria-hidden="true"></i></sup></p>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="radio-inline">
                                            <input type="radio" id="score[2.5]" value="5" {{$review->pivot->score['2.5'] == 5 ? "checked":""}} disabled> 5
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" id="score[2.5]" value="4" {{$review->pivot->score['2.5'] == 4 ? "checked":""}} disabled> 4
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" id="score[2.5]" value="3" {{$review->pivot->score['2.5'] == 3 ? "checked":""}} disabled> 3
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" id="score[2.5]" value="2" {{$review->pivot->score['2.5'] == 2 ? "checked":""}} disabled> 2
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" id="score[2.5]" value="1" {{$review->pivot->score['2.5'] == 1 ? "checked":""}} disabled> 1
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <p>2.6 Does the English and/or language usage meet the technical Conference standards ? <sup><i class="fa fa-asterisk text-danger" aria-hidden="true"></i></sup></p>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="radio-inline">
                                            <input type="radio" id="score[2.6]" value="5" {{$review->pivot->score['2.6'] == 5 ? "checked":""}} disabled> 5
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" id="score[2.6]" value="4" {{$review->pivot->score['2.6'] == 4 ? "checked":""}} disabled> 4
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" id="score[2.6]" value="3" {{$review->pivot->score['2.6'] == 3 ? "checked":""}} disabled> 3
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" id="score[2.6]" value="2" {{$review->pivot->score['2.6'] == 2 ? "checked":""}} disabled> 2
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" id="score[2.6]" value="1" {{$review->pivot->score['2.6'] == 1 ? "checked":""}} disabled> 1
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            3. Other Judgements
                        </div>
                        <div class="panel-body">
                            <p>3.1 Does the work show its potential contribution to any practical applications ? <sup><i class="fa fa-asterisk text-danger" aria-hidden="true"></i></sup></p>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="radio-inline">
                                            <input type="radio" id="score[3.1]" value="5" {{$review->pivot->score['3.1'] == 5 ? "checked":""}} disabled> 5
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" id="score[3.1]" value="4" {{$review->pivot->score['3.1'] == 4 ? "checked":""}} disabled> 4
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" id="score[3.1]" value="3" {{$review->pivot->score['3.1'] == 3 ? "checked":""}} disabled> 3
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" id="score[3.1]" value="2" {{$review->pivot->score['3.1'] == 2 ? "checked":""}} disabled> 2
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" id="score[3.1]" value="1" {{$review->pivot->score['3.1'] == 1 ? "checked":""}} disabled> 1
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <p>3.2 How high the degree of this paper's duplication with other published work(s) (plagiarism) ? --- 5 = very high degree, 4 = high degree, 3 = low degree, 2 = very low degree, 1 = Unknown <sup><i class="fa fa-asterisk text-danger" aria-hidden="true"></i></sup></p>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="radio-inline">
                                            <input type="radio" id="score[3.2]" value="5" {{$review->pivot->score['3.2'] == 5 ? "checked":""}} disabled> 5
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" id="score[3.2]" value="4" {{$review->pivot->score['3.2'] == 4 ? "checked":""}} disabled> 4
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" id="score[3.2]" value="3" {{$review->pivot->score['3.2'] == 3 ? "checked":""}} disabled> 3
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" id="score[3.2]" value="2" {{$review->pivot->score['3.2'] == 2 ? "checked":""}} disabled> 2
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" id="score[3.2]" value="1" {{$review->pivot->score['3.2'] == 1 ? "checked":""}} disabled> 1
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <p>3.3 Should this paper be recommended for best young scientist award ? <sup><i class="fa fa-asterisk text-danger" aria-hidden="true"></i></sup></p>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="radio-inline">
                                            <input type="radio" id="bpp_recommend" value="1" {{$review->pivot->bpp_recommend == 1 ? "checked":""}} disabled> Yes
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" id="bpp_recommend" value="0" {{$review->pivot->bpp_recommend == 0 ? "checked":""}} disabled> No
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            4. About the Referee
                        </div>
                        <div class="panel-body">
                            <p>4.1 How high you confidence in evaluating this work ? <sup><i class="fa fa-asterisk text-danger" aria-hidden="true"></i></sup></p>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="radio-inline">
                                            <input type="radio" id="score[4.1]" value="5" {{$review->pivot->score['4.1'] == 5 ? "checked":""}} disabled> 5
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" id="score[4.1]" value="4" {{$review->pivot->score['4.1'] == 4 ? "checked":""}} disabled> 4
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" id="score[4.1]" value="3" {{$review->pivot->score['4.1'] == 3 ? "checked":""}} disabled> 3
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" id="score[4.1]" value="2" {{$review->pivot->score['4.1'] == 2 ? "checked":""}} disabled> 2
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" id="score[4.1]" value="1" {{$review->pivot->score['4.1'] == 1 ? "checked":""}} disabled> 1
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            5. Review comments
                        </div>
                        <div class="panel-body">
                            <p>5.1 Additional Comments to authors (Strength)</p>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-12">
                                        <textarea id="comment_str" class="form-control" rows="3" disabled>{{$review->pivot->comment_str}}</textarea>

                                    </div>
                                </div>
                            </div>

                            <p>5.2 Additional Comments to authors (Weakness)</p>
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
