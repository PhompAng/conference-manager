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
                <td></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
