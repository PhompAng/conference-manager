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
                    <td><a href="{{URL::route("show" , ["id" => $conf->id])}}">{{$conf->name}}</a></td>
                    <td><a href="{{URL::to($conf->url)}}">{{URL::to($conf->url)}}</a></td>
                    <td>
                        <form action="{{URL::route('destroy', ["id"=>$conf->id])}}" method="post">
                            {!! csrf_field() !!}
                            {!! method_field('DELETE') !!}
                            <span>
                                <a href="{{URL::route("show" , ["id" => $conf->id])}}" class="btn btn-default btn-xs" data-toggle="tooltip"  title="View">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </a>
                                View
                            </span>
                            <span>
                                <a href="{{URL::route('edit', ["id" => $conf->id])}}" class="btn btn-default btn-xs" data-toggle="tooltip"  title="Edit">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                </a>
                                Edit
                            </span>
                            <br>
                            <span>
                                <a href="{{URL::route('user.index', ["conf" => $conf->id])}}" class="btn btn-default btn-xs" data-toggle="tooltip"  title="Users">
                                    <i class="fa fa-users" aria-hidden="true"></i>
                                </a>
                                Users
                            </span>
                            <span>
                                <button type="submit" class="btn btn-danger btn-xs" data-toggle="tooltip" title="Delete">
                                    <i class="fa fa-times"></i>
                                </button>
                                Delete
                            </span>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
