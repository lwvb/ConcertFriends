@extends('layouts.master')

@section('content')
    <div class="Site-content">
        <div class="Container">
            <h2>About</h2>
            Do you enjoy going to concerts? We do, only friends are not always available and going alone is not as fun. We created this website to find new friends for these occasions.
            <h3>Team A</h3>
            This website is created by 'Team A' which consist of two members. The good looking Petra who was in charge of making this site looking good. The practical Leendert made sure everyting worked as we intended it should work.
            <h3>Hackaton</h3>
            We made this site for the <a href="https://www.koding.com/Hackathon">2016 hack.summit() hackaton</a>.
        </div>
    </div>
    @section ('footer')
        @include ('footer')
    @show
@stop

@section('scripts')
@stop