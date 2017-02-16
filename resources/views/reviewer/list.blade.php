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
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
