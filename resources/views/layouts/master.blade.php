<!DOCTYPE html>
<html>
    <head>
        <title>ConcertFriends</title>
        <link href="/css/app.css" rel="stylesheet" type="text/css">
        <script src="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.js"></script>
    </head>
    <body>
        <div class="Site">
            <div class="Header Container">
                <h1 class="Header-title u-marginAn"> ConcertFriends </h1>
                <div class="Nav">
                    <a class="Nav-item"></a>
                    <a class="Nav-item">Add event</a>
                    <a class="Nav-item">Login</a>
                </div>
            </div>
            @section('content')
            @show
        </div>
        
        @include('icons')
                
        @section('scripts')
        @show
        
    </body>
</html>
