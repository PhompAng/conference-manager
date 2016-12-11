@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <ul class="nav nav-pills nav-stacked">
                <li role="presentation" class="{{ $menu == "home" ? "active":"" }}"><a href="{{URL($prefix."/")}}">Home</a></li>
                <li role="presentation" class="{{ $menu == "personal" ? "active":"" }}"><a href="{{URL($prefix."/edit")}}">Personal Information</a></li>
                <li role="presentation" class="{{ $menu == "paper" ? "active":"" }}"><a href="{{URL($prefix."/paper")}}">Paper Submission</a></li>
                <li role="presentation" class="{{ $menu == "list" ? "active":"" }}"><a href="{{URL($prefix."/list")}}">Paper List</a></li>
                <li role="presentation" class="{{ $menu == "camera" ? "active":"" }}"><a href="#">Camera Ready Submission</a></li>
                <li role="presentation"><a href="#">Logout</a></li>
            </ul>
        </div>
        <div class="col-md-9">
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
