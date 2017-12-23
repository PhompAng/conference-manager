@extends('home')
@section('body')
    @if(Session::has('success'))
        <div class="alert alert-success"> {{Session::get('success')}} </div>
    @endif

    <table class="table table-hover table-bordered">
        <thead>
        <tr>
            <th>PID</th>
            <th>Area</th>
            <th>Title</th>
            <th>Paper</th>
            <th>Status</th>
            <th>Submitter</th>
            <th>Country</th>
            <th>Decision</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($papers as $paper)
            <tr>
                <td>{{$paper->id}}</td>
                <td>
                    {{App\Model\Paper::getAreaIndex($paper)}}
                </td>
                <td>
                    {{$paper->title}}<br>
                    Keywords:
                    @foreach($paper->topics as $topic)
                        {{$topic}}
                    @endforeach
                </td>
                <td class="text-center">
                    <a href="{{URL::to($paper->file)}}"><i class="fa fa-file-pdf-o fa-3x" aria-hidden="true"></i></a>
                    <br>
                    <span>Last Update</span><br>
                    <span>{{$paper->updated_at}}</span>
                </td>
                <td class="text-center">
                    {{$paper->status}}
                    @if($paper->status != 'withdraw')
                        <br>
                        Avg: {{$paper['avg']}} BestPP: {{$paper['bpp']}}
                        <br>
                        <span>
                        <a href="{{URL::route('review.index', ["url"=>$prefix, "paper_id" => $paper->id])}}" class="btn btn-primary btn-xs" data-toggle="tooltip"  title="Review">
                            Details
                        </a>
                    </span>
                    @endif
                </td>
                <td class="text-center">
                    {{App\User::getFullName($paper->user)}}
                    <br>
                    {{$paper->user->email}}
                </td>
                <td>{{$paper->user->country}}</td>
                <td>
                    @if($paper->decision != null)
                        {{$paper->decision}}
                    @endif
                    @if(Auth::user()->can('tpc'))
                        <span>
                        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#decisionModal{{$paper->id}}">
                            Decision
                        </button>
                        </span>
                    @endif

                    <div id="decisionModal{{$paper->id}}" class="modal fade" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">Make Decision (Paper ID: {{$paper->id}})</h4>
                                    </div>
                                    <div class="modal-body text-center">
                                        <form action="{{URL::route('paper.accepted', ["url"=>$prefix, "paper_id" => $paper->id])}}" method="post">
                                            {!! csrf_field() !!}
                                            <button type="submit" class="btn btn-primary">Accepted</button>
                                        </form>
                                        <br>
                                        <form action="{{URL::route('paper.rejected', ["url"=>$prefix, "paper_id" => $paper->id])}}" method="post">
                                            {!! csrf_field() !!}
                                            {!! method_field('DELETE') !!}
                                            <button type="submit" class="btn btn-danger">Rejected</button>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                </td>
                <td>
                    @can('review', $paper)
                        <span>
                        <a href="{{URL::route('review.create', ["url"=>$prefix, "paper_id" => $paper->id])}}" class="btn btn-default btn-xs" data-toggle="tooltip"  title="Review">
                            <i class="fa fa-comment" aria-hidden="true"></i>
                        </a>
                            {{-- TODO update review--}}
                            Review
                    </span>
                    @endcan
                    <br>
                    @can('assign', $paper)
                        <span>
                        <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal{{$paper->id}}">
                            <i class="fa fa-user-plus" aria-hidden="true"></i>
                        </button>
                        Assign
                        </span>
                        <div id="myModal{{$paper->id}}" class="modal fade" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">Choose Reviewer (Paper ID: {{$paper->id}})</h4>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table table-hover table-bordered">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Affiliation</th>
                                                <th>Email</th>
                                                <th>Country</th>
                                                <th>Role</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($reviewers as $reviewer)
                                                <tr>
                                                    <td>{{$reviewer->id}}</td>
                                                    <td>
                                                        {{App\User::getFullName($reviewer)}}
                                                    </td>
                                                    <td class="text-center">
                                                        {{$reviewer->affiliation}}
                                                    </td>
                                                    <td class="text-center">
                                                        {{$reviewer->email}}
                                                    </td>
                                                    <td class="text-center" style="vertical-align: middle;">
                                                        {{$reviewer->country}}
                                                    </td>
                                                    <td class="text-center">
                                                        {{App\User::getRole($reviewer->role)}}
                                                    </td>
                                                    <td>
                                                        @if($paper->reviewers->contains('id', $reviewer->id))
                                                            <form action="{{URL::route('review.unassign', ["url"=>$prefix, "paper_id" => $paper->id, "user_id" => $reviewer->id])}}" method="post">
                                                                {!! csrf_field() !!}
                                                                {!! method_field('DELETE') !!}
                                                                <span>
                                                                    <button type="submit" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Unassign">
                                                                        <i class="fa fa-user-times" aria-hidden="true"></i>
                                                                    </button>
                                                                    Unassign
                                                                </span>
                                                            </form>
                                                        @else
                                                            <form action="{{URL::route('review.assign', ["url"=>$prefix, "paper_id" => $paper->id, "user_id" => $reviewer->id])}}" method="post">
                                                                {!! csrf_field() !!}
                                                                <span>
                                                                    <button type="submit" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Assign">
                                                                        <i class="fa fa-user-plus" aria-hidden="true"></i>
                                                                    </button>
                                                                    Assign
                                                                </span>
                                                            </form>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                    @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
