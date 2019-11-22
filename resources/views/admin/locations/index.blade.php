@extends('layouts.app')

@section('content')
<table class=" table table-hover">
    <thead>
        <tr>
            <th>Sn</th>
            <th>Device Id</th>
            <th>Latitude</th>
            <th>Longitude</th>
            <th>Time</th>

        </tr>
    </thead>

    <tbody>
        @foreach ($locations as $location)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$location->device_id}}</td>
            <td>{{$location->latitude}}</td>
            <td>{{$location->longitude}}</td>
            <td>{{$location->time}}</td>
        </tr>
        @endforeach

    </tbody>
</table>
@endsection