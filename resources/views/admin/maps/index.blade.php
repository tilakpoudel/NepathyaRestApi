@extends('layouts.app')

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class=" form-group col-md-3">
      <input type="hidden" value="{{ csrf_token() }}" id="_token" name="_token" />
      <label for="user">Select Device:</label>
      <select name="vechileid" id="vechileid" class="form-control" onchange="getLocation(this)">
        <option value="">Select device</option>
        <option value="3e37223826f3bc58">Tilak </option>
        <option value="2488c747c04af93d">Manoj Sir</option>
        <option value="3">Bus C</option>
      </select>
    </div>
    <div class="col-md-9">
      <div id="map">

      </div>
    </div>
  </div>
</div>


@endsection