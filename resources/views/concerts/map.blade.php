@extends('layouts.master')

@section('content')
    <div class="Event-map" id="map">

    </div>
    <div class="Event-content Container">
        <div class="Event-search">

            <form name="searchForm" id="searchForm" class="Search-form" action="" method="get">
                <input
                    placeholder="Find your event"
                    type="search"
                    type="text"
                    name="q"
                    class="Search-field"
                    id="searchField"
                    autofocus="autofocus"
                    autocomplete="off"
                    value="{{ $search or '' }}"
                >
                <button id="searchButton" class="Button Search-button" type="submit">
                    <div class="searchIcon">
                        <svg class="Icon Icon--search"><use xlink:href="#Icon--search"></use></svg>
                    </div>
                </button>
            </form>

        </div>
        <div class="Event-add">
            <button id="eventAdd" class="Button Button-add" type="submit">
                + Add event
            </button>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        var map = L.map('map').setView([52.162, 5.095], 9);

        L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://mapbox.com">Mapbox</a>',
            maxZoom: 18,
            id: 'pbredewold.p74hj116',
            accessToken: 'pk.eyJ1IjoicGJyZWRld29sZCIsImEiOiJ6V2NGajNBIn0.37Amj6Jg93KOTbvtvPthog'
        }).addTo(map);
    </script>
@stop