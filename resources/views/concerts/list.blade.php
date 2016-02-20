@extends('layouts.master')

@section('content')
    <div class="Site-content">
        <ul>
            @foreach ($concerts as $concert)
                <li><a href="/concert/{{ $concert['_id'] }}">{{ $concert['_source']['name'] }}</a></li>
            @endforeach
        </ul>
    </div>
@stop

@section('scripts')

@stop