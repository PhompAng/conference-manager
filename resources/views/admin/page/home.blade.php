@extends('admin.home')
@section('body')
    @if(Session::has('success'))
        <div class="alert alert-success"> {{Session::get('success')}} </div>
    @endif

    <table class="table table-hover table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>URL</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($confs as $conf)
                <tr>
                    <td>{{$conf->id}}</td>
                    <td><a href="{{URL::to("/admin/".$conf->id)}}">{{$conf->name}}</a></td>
                    <td><a href="{{URL::to($conf->url)}}">{{URL::to($conf->url)}}</a></td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
