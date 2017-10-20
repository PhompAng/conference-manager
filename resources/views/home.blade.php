@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <ul class="nav nav-pills nav-stacked">
                <li role="presentation" class="{{ $menu == "home" ? "active":"" }}"><a href="{{URL($prefix."/")}}">Home</a></li>
                <li role="presentation" class="{{ $menu == "personal" ? "active":"" }}"><a href="{{URL($prefix."/edit")}}">Personal Information</a></li>
                @if (Auth::user()->can('author'))
                    <li role="presentation" class="{{ $menu == "paper" ? "active":"" }}"><a href="{{URL($prefix."/paper")}}">Paper Submission</a></li>
                    <li role="presentation" class="{{ $menu == "list" ? "active":"" }}"><a href="{{URL($prefix."/list")}}">Paper List</a></li>
                    <li role="presentation" class="{{ $menu == "camera" ? "active":"" }}"><a href="{{URL($prefix."/camera_ready")}}">Camera Ready Submission</a></li>
                @endif
                @if (Auth::user()->can('reviewer') || Auth::user()->can('tpc'))
                    <li role="presentation" class="{{ $menu == "list" ? "active":"" }}"><a href="{{URL($prefix."/list")}}">Paper List</a></li>
                @endif
                @if(Auth::user()->can('tpc'))
                    {{--<li role="presentation" class="{{ $menu == "report" ? "active":"" }}"><a href="{{URL($prefix."/list")}}">Report</a></li>--}}
                    <li role="presentation" class="{{ $menu == "author" ? "active":"" }}"><a href="{{URL($prefix."/author")}}">Authors</a></li>
                    <li role="presentation" class="{{ $menu == "reviewer" ? "active":"" }}"><a href="{{URL($prefix."/reviewer")}}">Reviewers</a></li>
                @endif
                <li role="presentation">
                    <a href="{{ url($prefix.'/logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        Logout
                    </a>

                    <form id="logout-form" action="{{ url($prefix.'/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
        </div>
        <div class="col-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">
                    {{$title}}
                </div>
                <div class="panel-body">
                    @yield('body')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
