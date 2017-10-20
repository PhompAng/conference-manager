@extends('home')
@section('body')
    @if(Session::has('success'))
        <div class="alert alert-success"> {{Session::get('success')}} </div>
    @endif

    <table class="table table-hover table-bordered">
        <thead>
        <tr>
            <th>PID</th>
            <th>Title</th>
            <th>Status</th>
            <th>Camera Ready</th>
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
                    {{$paper->status}}
                </td>
                <td class="text-center">
                    @if(!is_null($paper->camera_ready))
                    <a href="{{URL::to($paper->camera_ready)}}"><i class="fa fa-file-pdf-o fa-3x" aria-hidden="true"></i></a>
                    <br>
                    <span>Last Update</span><br>
                    <span>{{$paper->updated_at}}</span>
                    <br>
                    @endif
                    @if(!isset($conf->camera_deadline) || \Carbon\Carbon::now()->gt(\Carbon\Carbon::parse($conf->camera_deadline)))
                    <span>Time Up!</span>
                    @else
                        <a href="{{URL::route('camera_ready.create', ['url' => $prefix, 'paper_id' => $paper->id])}}" class="btn btn-primary btn-sm">Update</a>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
