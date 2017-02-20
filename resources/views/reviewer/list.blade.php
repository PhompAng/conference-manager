@extends('home')
@section('body')
    @if(Session::has('success'))
        <div class="alert alert-success"> {{Session::get('success')}} </div>
    @endif

    <table class="table table-hover table-bordered">
        <thead>
        <tr>
            <th>Code</th>
            <th>Area</th>
            <th>Title</th>
            <th>Paper</th>
            <th>Status</th>
            <th>Submitter</th>
            <th>Country</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($papers as $paper)
            <tr>
                <td>{{$paper->id}}</td>
                <td>{{$paper->area}}</td>
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
                </td>
                <td class="text-center">
                    {{App\User::getAcademicPosition($paper->user->academic_position)}} {{App\User::getTitle($paper->user->title)}} {{$paper->user->name}} {{$paper->user->family_name}}
                    <br>
                    {{$paper->user->email}}
                </td>
                <td>{{$paper->user->country}}</td>
                <td>
                    @can('review', $paper)
                    <span>
                        <a href="{{URL::route('review.create', ["url"=>$prefix, "paper_id" => $paper->id])}}" class="btn btn-default btn-xs" data-toggle="tooltip"  title="Review">
                            <i class="fa fa-comment" aria-hidden="true"></i>
                        </a>
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
                                    <h4 class="modal-title">Choose Reviewer</h4>
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
                                                    {{App\User::getAcademicPosition($reviewer->academic_position)}} {{App\User::getTitle($reviewer->title)}} {{$reviewer->name}} {{$reviewer->family_name}}
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
                                <button type="submit" class="btn btn-primary btn-xs" data-toggle="tooltip"  title="Unassign">
                                    <i class="fa fa-user-times" aria-hidden="true"></i>
                                </button>
                            Unassign
                            </span>
                                                    </form>
                                                    @else
                                                    <form action="{{URL::route('review.assign', ["url"=>$prefix, "paper_id" => $paper->id, "user_id" => $reviewer->id])}}" method="post">
                                                        {!! csrf_field() !!}
                                                        <span>
                                <button type="submit" class="btn btn-primary btn-xs" data-toggle="tooltip"  title="Assign">
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
