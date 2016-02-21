<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>ConcertFriends</title>
        <link href="/css/app.css" rel="stylesheet" type="text/css">
        <script src="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
    </head>
    <body>
        <div class="Site">
            <div class="Header">
                <div class="Container">
                    <h1 class="Header-title u-marginAn"> <a href="/">ConcertFriends </a></h1>
                    <div class="Nav">
                        <ul class="Nav-items">
                            <li class="Nav-item">
                                <a href="/concert/new">
                                    <svg class="Icon Icon--add"><use xlink:href="#Icon--add"></use></svg>
                                    <span class="Item">Add event</span>
                                </a>
                            </li>
                            <li class="Nav-item">
                                <a href="#">
                                    <svg class="Icon Icon--login"><use xlink:href="#Icon--login"></use></svg>
                                    <span class="Item"> Login</span>
                                </a>
                            </li>
                        </ul>
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
