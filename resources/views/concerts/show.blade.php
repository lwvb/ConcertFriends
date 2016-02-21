@extends('layouts.master')

@section('content')
    <div class="Site-content">
        <div class="Container">
            <h1 class="Event-name">{{ $concert->getName() }}</h1><br>
            @if ($concert->isEditableByCurrentUser())
                <a href="/concert/{{ $concert->getId() }}/edit">
                    <button class="Button">Edit</button>
                </a>
            @endif
            <date class="Event-date">
                <svg class="Icon Icon--calender"><use xlink:href="#Icon--calender"></use></svg>
                {{ $concert->getDateString() }}
            </date>
            <p class="Event-city">
                <svg class="Icon Icon--marker"><use xlink:href="#Icon--marker"></use></svg>
                {{ $concert->getCity() }}
            </p>
            <p class="Event-description">
                {{ $concert->getDescription() }}
            </p>
            <div class="Event-audience">
                <h3>Who's going</h3>
                <div id="event-users">
                @if (Auth::check())
                    @if (is_array($concert->getUsers()))
                        @foreach ($concert->getUsers() as $user)
                            <a href="https://facebook.com/{{ $user['fb_uid'] }}">
                                <div class="Event-person">
                                    <img src="https://graph.facebook.com/v2.5/{{ $user['fb_uid'] }}/picture?type=normal" alt="{{ $user['name'] }}" title="{{ $user['name'] }}">
                                </div>
                            </a>
                        @endforeach
                    @else
                        <p id="event-users-placeholder">Be the first to join</p>
                    @endif
                @else
                    <p>Login to see who else is going and want to be your new concert friend.</p>
                @endif
                </div>
            </div>
            @if (Auth::check())
                @if ($concert->hasUser(Auth::user()->getFacebookUid()))
                    <button class="Button Button--full disabled">You are going, Yeah!</button>
                @else
                    <button class="Button Button--full" id="event-subscribe">Join and meet up</button>
                @endif
            @else
                <a href="/login/facebook"><button class="Button Button--full">Login to join</button></a>
            @endif
        </div>
    </div>
    @section ('footer')
        @include ('footer')
    @show
@stop

@section('scripts')
@if (Auth::check())
<script>
$('#event-subscribe').click(function() {
    $('#event-subscribe').prop("disabled",true);
    $('#event-subscribe').text('...');

    $.ajax('/api/subscribe/{{ $concert->getId() }}', {
        success: function(data) {
            if(data) {
                $('#event-subscribe').text('You are going, Yeah!');
                $('#event-users-placeholder').hide();
                $('#event-users').append('<div class="Event-person"><img src="https://graph.facebook.com/v2.5/{{ Auth::user()->getFacebookUid() }}/picture?type=normal" alt="{{ Auth::user()->getName() }}"></div>');
            } else {
                $('#event-subscribe').text('Oops, something did go wrong.');
            }
        }
    });

});
</script>
@endif
@stop