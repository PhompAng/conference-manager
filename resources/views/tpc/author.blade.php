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
            <th>Paper ID</th>
        </tr>
        </thead>
        <tbody>
        @foreach($authors as $author)
            <tr>
                <td>{{$author->id}}</td>
                <td>{{App\User::getFullName($author)}}</td>
                <td class="text-center">
                    {{$author->affiliation}}
                </td>
                <td class="text-center">
                    {{$author->email}}
                </td>
                <td class="text-center" style="vertical-align: middle;">
                    {{$author->papers->implode('id', ', ')}}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
