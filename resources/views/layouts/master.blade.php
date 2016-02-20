<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>ConcertFriends</title>
        <link href="/css/app.css" rel="stylesheet" type="text/css">
        <script src="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.js"></script>
        <meta name="viewport" content"width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div class="Site">
            <div class="Header Container">
                <h1 class="Header-title u-marginAn"> <a href="/">ConcertFriends </a></h1>
                <div class="Nav">
                    <a class="Nav-item"><svg class="Icon Icon--add"><use xlink:href="#Icon--add"></use></svg>Add event</a>
                    <a class="Nav-item"><svg class="Icon Icon--login"><use xlink:href="#Icon--login"></use></svg>Login</a>
                </div>
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
