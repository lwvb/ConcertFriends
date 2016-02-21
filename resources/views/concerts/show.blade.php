@extends('layouts.master')

@section('content')
    <div class="Site-content">
        <div class="Container">
            <h1 class="Event-name">{{ $concert->getName() }}</h1><br>
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
                <div class="Event-person"></div>
                <div class="Event-person"></div>
                <div class="Event-person"></div>
                <div class="Event-person"></div>
                <div class="Event-person"></div>
            </div>
            <button class="Button Button--full">Join and meet up</button>
        </div>
    </div>
    @section ('footer')
        @include ('footer')
    @show
@stop

@section('scripts')

@stop