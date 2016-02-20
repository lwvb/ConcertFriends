@extends('layouts.master')

@section('content')
    <div class="Site-content">
        <div class="Container">
            <div class="Filters">
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
                <div class="Event-selectDate">
                    <button id="eventDate" class="Button Button-date" type="submit">
                        <svg class="Icon Icon--calender"><use xlink:href="#Icon--calender"></use></svg>
                    </button>
                </div>
                <div class="Event-selectCity">
                    <button id="eventCity" class="Button Button-city" type="submit">
                        <svg class="Icon Icon--marker"><use xlink:href="#Icon--marker"></use></svg>
                    </button>
                </div> 
                <div class="Event-selectSwitch">
                    <a href="/">
                        <button id="eventSwitch" class="Button Button-switch" type="submit">
                            <svg class="Icon Icon--map"><use xlink:href="#Icon--map"></use></svg>
                        </button>
                    </a>
                </div>
               
            </div>
            
            <ul class="List List--bare">
                @foreach ($concerts as $concert)
                    <li class="List-item">
                        <a class="Event-link" href="/concert/{{ $concert['_id'] }}">
                            <h3 class="Event-name">{{ $concert['_source']['name'] }}</h3><br>
                            <date class="Event-date"> 
                                <svg class="Icon Icon--calender"><use xlink:href="#Icon--calender"></use></svg>
                                19 januari 2016 
                            </date>
                            <p class="Event-city">
                                <svg class="Icon Icon--marker"><use xlink:href="#Icon--marker"></use></svg>
                                Arnhem 
                            </p>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@stop

@section('scripts')

@stop