<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @if (Auth::user())
                        <li class="nav-item ">
                            <a href="{{route('locations.index')}}">Locations</a>
                        </li>
                        <li class="nav-item" style="margin-left:15px;">
                            <a href="{{route('maps.index')}}">View On Map</a>
                        </li>
                        @endif

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
{{-- <script>
    // Initialize and add the map
        function initMap() {
          // The location of Uluru
          var uluru = {lat: -25.344, lng: 131.036};
          // The map, centered at Uluru
          var map = new google.maps.Map(
              document.getElementById('map'), {zoom: 4, center: uluru});
          // The marker, positioned at Uluru
          var marker = new google.maps.Marker({position: uluru, map: map});
        }
</script> --}}

<script src="https://code.jquery.com/jquery-3.4.1.min.js"
    integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=GOOGLE MAP API&libraries=places">
</script>

{{-- <script src="{{asset('js/script.js')}}"></script> --}}

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>

function getLocation(deviceid){
        var deviceid = deviceid.value;
        if(deviceid != ''){
        var _token = $('input[name="_token"]').val();
        // console.log(deviceid,_token);
        $.ajax({
            url:"{{ route('dynamic.fetch') }}",
            method :"POST",
            dataType:"html",
            data:{deviceId:deviceid,_token:_token},
            success:function(result){
                var parsed_data = JSON.parse(result);
                var latitude = parseFloat(parsed_data.latitude);
                var longitude = parseFloat(parsed_data.longitude);
                var device_coordinate  = { lat: latitude, lng: longitude };
                console.log(device_coordinate);
                // createMap(latitude,longitude);

                var map = new google.maps.Map(
                document.getElementById('map'), {
                zoom: 10,
                center: { lat:latitude, lng:longitude },
                // scrollWheel:false,
            });
        // The marker, positioned at latlongitude
            var marker = new google.maps.Marker({
                position: { lat:latitude, lng:longitude },
                map: map,
                title: "I am here"
            });
            },
            error:function(jqXHR, timeout, message){
              console.log( message);
            }
        })
    }else
    console.log("no data");
    }
    var map;
$(document).ready(function () {
    geoLocationInit();

    function geoLocationInit() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(success, fail);
        } else {
            alert("Location not supported in this browser");
        }
    }
    // if location peremission given
    function success(position) {
        console.log(position);
        var latval = position.coords.latitude;
        var lgnval = position.coords.longitude;
        var mylatlang = { lat: latval, lng: lgnval };

        console.log(latval,lgnval);
        createMap(latval,lgnval);
    }
    // location permission not given
    function fail() {
        alert("Coud not get position");
    }



    function createMap(lat,lang) {
        var lat = parseFloat(lat);
        var lang = parseFloat(lang);
        console.log(lat,lang);
        var map = new google.maps.Map(
            document.getElementById('map'), {
            zoom: 10,
            center: { lat:lat, lng:lang },
            // scrollWheel:false,
        });
        // The marker, positioned at latlang
        var marker = new google.maps.Marker({
            position: { lat:lat, lng:lang },
            map: map,
            title: "I am here"
        });
    }

    function createMarker(latlang, icn, name) {
        var marker = new google.maps.Marker({
            position: latlang,
            map: map,
            icon: icn,
            title: name,
        });

    }

    function nearbySearch(latlang, searchType) {
        var request = {
            location: latlang,
            radius: '500',
            query: searchType
        };

        // search nearby places service
        service = new google.maps.places.PlacesService(map);
        service.nearbySearch(request, callback);

        function callback(results, status) {
            console.log(results);
            if (status == google.maps.places.PlacesServiceStatus.OK) {
                for (var i = 0; i < results.length; i++) {
                    var place = results[i];
                    var latlang = place.geometry.location;
                    var icn = place.icon;
                    var name = place.name;
                    createMarker(latlang, icn, name);
                }
            }
        }
    }



});
</script>

</html>
