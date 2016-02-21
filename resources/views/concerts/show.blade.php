@extends('layouts.master')

@section('content')
    <div class="Site-content">
        <div class="Container">
            <h1 class="Event-name">{{ $concert->getName() }}</h1><br>
            <date class="Event-date">
                <svg class="Icon Icon--calender"><use xlink:href="#Icon--calender"></use></svg>
                19 januari 2016
            </date>
            <p class="Event-city">
                <svg class="Icon Icon--marker"><use xlink:href="#Icon--marker"></use></svg>
                {{ $concert->getCity() }}
            </p>
            <p class="Event-description">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas vitae leo vel nibh venenatis dignissim at ut justo. Mauris interdum dolor et tortor venenatis, ut tristique elit fermentum. Curabitur a velit dictum leo ullamcorper euismod eu et lorem. Cras a metus vitae felis suscipit posuere. Curabitur a ipsum id sem pharetra ornare id at massa. Nunc volutpat, metus a porttitor vehicula, mauris magna placerat metus, sit amet mollis leo libero vitae ligula. Cras commodo efficitur convallis. Donec ligula nisl, consequat sit amet risus id, semper fringilla libero. Pellentesque mollis tellus eu tellus porttitor, in dictum felis congue. Proin pretium lacus nec velit laoreet tincidunt.
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