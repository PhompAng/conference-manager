@extends('admin.layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <ul class="nav nav-pills nav-stacked">
                    <li role="presentation"><a href="">Home</a></li>
                    <li role="presentation">
                        <a href="{{ url('/admin/logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ url('/admin/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </div>

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        {{$title}}
                    </div>
                    <div class="panel-body">
                        {{--@yield('body')--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
