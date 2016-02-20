<!DOCTYPE html>
<html>
    <head>
        <title>ConcertFriends</title>
        <link href="/css/app.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="Site">
            <div class="Header Container">
                <h1 class="Header-title u-marginAn"> ConcertFriends </h1>
                <p class="Header-description">Find someone to go with you to an awesome event</p>
            </div>
            <div class="Event-map">
                
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
        </div>
        
        @include('icons')
        
    </body>
</html>
