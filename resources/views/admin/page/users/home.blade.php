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
                    <td>{{App\User::getFullName($user)}}</td>
                    <td>{{App\User::getRole($user->role)}}</td>
                    <td>
                        <span>
                            <a href="{{URL::route("user.show",
                            ["conf" => $conf->id,
                            "user" => $user->id])}}"
                               class="btn btn-default btn-xs"
                               data-toggle="tooltip"
                               title="View"
                               disabled>
                                <i class="fa fa-eye"></i>
                            </a>
                            View
                        </span>
                        <span>
                            <a href="{{URL::route('user.edit',
                            ["conf" => $conf->id,
                            "user" => $user->id])}}"
                               class="btn btn-default btn-xs"
                               data-toggle="tooltip"
                               title="Edit"
                               disabled>
                                <i class="fa fa-pencil-square-o"></i>
                            </a>
                            Edit
                        </span>
                        <br>
                        <form action="{{URL::route('setRole',
                        ["conf" => $conf->id,
                        "user" => $user->id])}}"
                              method="post">
                        {!! csrf_field() !!}
                        <input type="hidden" name="role" value="1">
                        <span>
                            <button type="submit"
                                    class="btn btn-primary btn-xs"
                                    data-toggle="tooltip"
                                    title="Make Author">
                                <i class="fa fa-user-circle"></i>
                            </button>
                            Make Author
                        </span>
                        </form>

                        <form action="{{URL::route('setRole',
                        ["conf" => $conf->id,
                        "user" => $user->id])}}"
                              method="post">
                        {!! csrf_field() !!}
                        <input type="hidden" name="role" value="2">
                        <span>
                            <button type="submit"
                                    class="btn btn-primary btn-xs"
                                    data-toggle="tooltip"
                                    title="Make Reviewer">
                                <i class="fa fa-user-circle"></i>
                            </button>
                            Make Reviewer
                        </span>
                        </form>
                        <form action="{{URL::route('setRole',
                        ["conf" => $conf->id,
                        "user" => $user->id])}}"
                              method="post">
                            {!! csrf_field() !!}
                            <input type="hidden" name="role" value="3">
                            <span>
                            <button type="submit"
                                    class="btn btn-primary btn-xs"
                                    data-toggle="tooltip"
                                    title="Make TPC">
                                <i class="fa fa-user-circle"></i>
                            </button>
                            Make TPC
                        </span>
                        </form>
                        <form action="{{URL::route('user.destroy',
                        ["conf" => $conf->id,
                        "user"=>$user->id])}}"
                              ethod="post"
                              onsubmit="return confirm('Do you want to remove this user ?')">
                            {!! csrf_field() !!}
                            {!! method_field('DELETE') !!}
                            <span>
                                <button type="submit"
                                        class="btn btn-danger btn-xs"
                                        data-toggle="tooltip"
                                        title="Delete">
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
