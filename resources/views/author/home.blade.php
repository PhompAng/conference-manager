@extends('home')
@section('body')
    <h3 class="text-center"> Welcome to EECON-39</h3>
    <h4 class="text-center">Conference Date : November 4-4, 2016</h4>
    <hr>
    <table class="table table-bordered table-hover">
        <thead>
        <tr class="info">
            <th>No.</th>
            <th>Schedule</th>
            <th>Date</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>1</td>
            <td>Paper submission deadline</td>
            <td>
                July 11, 2016 23:59:59
            </td>
        </tr>
        <tr>
            <td>2</td>
            <td>Acceptance announcement</td>
            <td>
                August 23, 2016 23:59:59
            </td>
        </tr>
        <tr>
            <td>3</td>
            <td>Camera-ready submission deadline</td>
            <td>
                September 5, 2016 23:59:59
            </td>
        </tr>
        <tr>
            <td>4</td>
            <td>Pre-registration deadline</td>
            <td>
                October 3, 2016 23:59:59
            </td>
        </tr>
        </tbody>
    </table>
@endsection
