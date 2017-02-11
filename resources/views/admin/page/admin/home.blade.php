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
                <th>Email</th>
                <th>Created_at</th>
                <th>Updated_at</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($admins as $admin)
                <tr>
                    <td>{{$admin->id}}</td>
                    <td>{{$admin->name}}</td>
                    <td>{{$admin->email}}</td>
                    <td>{{$admin->created_at}}</td>
                    <td>{{$admin->updated_at}}</td>
                    <td>
                        <form action="{{URL::route('admin.destroy', ["id"=>$admin->id])}}" method="post">
                            {!! csrf_field() !!}
                            {!! method_field('DELETE') !!}
                            <span>
                                <a href="{{URL::route("admin.show" , ["id" => $admin->id])}}" class="btn btn-default btn-xs" data-toggle="tooltip"  title="View">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </a>
                                View
                            </span>
                            <span>
                                <a href="{{URL::route('admin.edit', ["id" => $admin->id])}}" class="btn btn-default btn-xs" data-toggle="tooltip"  title="Edit">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                </a>
                                Edit
                            </span>
                            <br>
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

    <a href="{{URL::route('admin.create')}}" class="btn btn-success">Add Admin</a>
@endsection
