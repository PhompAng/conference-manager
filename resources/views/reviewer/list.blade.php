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
            <th>Country</th>
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
                <td>{{$paper->user->country}}</td>
                <td>
                    @can('review', $paper)
                        @if(!(\App\Model\Paper::isAlreadyReview($paper)))
                            <span>
                            <a href="{{URL::route('review.create', ["url"=>$prefix, "paper_id" => $paper->id])}}" class="btn btn-default btn-xs" data-toggle="tooltip"  title="Review">
                                <i class="fa fa-comment" aria-hidden="true"></i>
                            </a>
                            Review
                        </span>
                        @endif
                    @endcan
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
