@extends('home')
@section('body')
    @if(Session::has('success'))
        <div class="alert alert-success"> {{Session::get('success')}} </div>
    @endif

    <table class="table table-hover table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Affiliation</th>
            <th>Email</th>
            <th>Country</th>
            <th>Role</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($reviewers as $reviewer)
            <tr>
                <td>{{$reviewer->id}}</td>
                <td>
                    {{App\User::getAcademicPosition($reviewer->academic_position)}} {{App\User::getTitle($reviewer->title)}} {{$reviewer->name}} {{$reviewer->family_name}}
                </td>
                <td class="text-center">
                    {{$reviewer->affiliation}}
                </td>
                <td class="text-center">
                    {{$reviewer->email}}
                </td>
                <td class="text-center" style="vertical-align: middle;">
                    {{$reviewer->country}}
                </td>
                <td class="text-center">
                    {{App\User::getRole($reviewer->role)}}
                </td>
                <td>
                @if($user->id != $reviewer->id)
                    @if($reviewer->role == 2)
                        <form action="{{URL::to($conf->url.'/'.$reviewer->id.'/tpc')}}" method="post">
                            {!! csrf_field() !!}
                            <span>
                            <button type="submit" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Make TPC">
                                <i class="fa fa-user-circle" aria-hidden="true"></i>
                            </button>
                            Make TPC
                        </span>
                        </form>
                    @endif
                    @if($reviewer->role == 3)
                        <form action="{{URL::to($conf->url.'/'.$reviewer->id.'/tpc')}}" method="post">
                            {!! csrf_field() !!}
                            {!! method_field('DELETE') !!}
                            <span>
                                <button type="submit" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Remove TPC">
                                    <i class="fa fa-user-circle" aria-hidden="true"></i>
                                </button>
                                Remove TPC
                            </span>
                        </form>
                    @endif
                @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
