@extends('home')
@section('body')
    @if(Session::has('success'))
        <div class="alert alert-success"> {{Session::get('success')}} </div>
    @endif

    <table class="table table-hover">
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
                        Topics:
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
                    <td>
                        {{$paper->status}}
                    </td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
