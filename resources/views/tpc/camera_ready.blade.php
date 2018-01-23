@extends('home')
@section('body')
    <div class="alert-container">
        @if(Session::has('success'))
            <div class="alert alert-success">
                {{Session::get('success')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
        @endif
    </div>
    <table class="table table-hover table-bordered">
        <thead>
        <tr>
            <th>PID</th>
            <th>Area</th>
            <th>Title</th>
            <th>Camera Ready</th>
            <th>Status</th>
            <th>Submitter</th>
            <th>Country</th>
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
                    @if(!is_null($paper->camera_ready))
                    <a href="{{URL::to($paper->camera_ready)}}"><i class="fa fa-file-pdf-o fa-3x" aria-hidden="true"></i></a>
                    <br>
                    <span>Last Update</span><br>
                    <span>{{$paper->updated_at}}</span>
                    @endif
                </td>
                <td class="text-center">
                    @if($paper->status == 'pending')
                        Waiting for review
                    @else
                        {{$paper->status}}
                    @endif
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
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection