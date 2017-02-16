@extends('home')
@section('body')
    @if(Session::has('success'))
        <div class="alert alert-success"> {{Session::get('success')}} </div>
    @endif

    <table class="table table-hover table-bordered">
        <thead>
            <tr>
                <th>Code</th>
                <th>Title</th>
                <th>Paper</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($papers as $paper)
                <tr>
                    <td>{{$paper->id}}</td>
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
                        <br>
                        <a href="#" class="btn btn-primary btn-sm">View comments</a>
                    </td>
                    <td class="text-center" style="vertical-align: middle;">
                        @if(!isset($conf->paper_deadline) || \Carbon\Carbon::now()->gt(\Carbon\Carbon::parse($conf->paper_deadline)))
                            <span>Time Up!!</span>
                        @else
                            <span>
                                <a href="{{URL::route('paper.edit', ["url"=>$prefix, "id" => $paper->id])}}" class="btn btn-default btn-xs" data-toggle="tooltip"  title="Edit">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                </a>
                                Edit
                            </span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
