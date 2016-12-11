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
                    <td>
                        <a href="{{URL::to($paper->file)}}" class="btn btn-primary">Download</a>
                    </td>
                    <td></td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
