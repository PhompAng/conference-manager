@extends('home')
@section('body')
    <table class="table">
        <thead>
            <tr>
                <th>Code</th>
                <th>Title</th>
                <th>Camera Ready</th>
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
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
