@extends('layouts.master')

@section('content')
    <div class="Event-map" id="map"></div>
    <div class="Event-content">
        <div class="Container">
        <div class="Event-search">
            <form name="searchForm" id="searchForm" class="Search-form" action="" method="get">
                <input
                    placeholder="Find your next concert"
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
        <!-- TODO: make it work like filters
        <div class="Event-selectDate">
            <button id="eventDate" class="Button Button-date" type="submit">
                <svg class="Icon Icon--calender"><use xlink:href="#Icon--calender"></use></svg>
            </button>
        </div>
        <div class="Event-selectCity">
            <button id="eventCity" class="Button Button-city" type="submit">
                <svg class="Icon Icon--marker"><use xlink:href="#Icon--marker"></use></svg>
            </button>
        </div>-->
        <div class="Event-selectSwitch">
            <a href="/list">
                <button id="eventSwitch" class="Button Button-switch" type="submit">
                    <svg class="Icon Icon--list"><use xlink:href="#Icon--list"></use></svg>
                </button>
            </a>
        </div>
        </div>
    </div>
@stop

@section('scripts')
    <script src="/js/all.js"></script>
@stop