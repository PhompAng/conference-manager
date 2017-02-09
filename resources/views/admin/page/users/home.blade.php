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
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($conf->users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{App\User::getAcademicPosition($user->academic_position)}} {{App\User::getTitle($user->title)}} {{$user->name}} {{$user->family_name}}</td>
                    <td>{{App\User::getRole($user->role)}}</td>
                    <td>
                        <form action="{{URL::route('user.destroy', ["conf" => $conf->id, "user"=>$user->id])}}" method="post">
                            {!! csrf_field() !!}
                            {!! method_field('DELETE') !!}
                            <a href="{{URL::route("user.show" , ["conf" => $conf->id, "user" => $user->id])}}" class="btn btn-default btn-xs" data-toggle="tooltip"  title="View" disabled>
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </a>
                            <a href="{{URL::route('user.edit', ["conf" => $conf->id, "user" => $user->id])}}" class="btn btn-default btn-xs" data-toggle="tooltip"  title="Edit" disabled>
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </a>
                            <button type="submit" class="btn btn-danger btn-xs" data-toggle="tooltip" title="Delete">
                                <i class="fa fa-times"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
