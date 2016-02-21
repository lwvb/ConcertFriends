@extends('layouts.master')

@section('content')
    <div class="Container">
        <h1>{{ $concert['_source']['name'] }}</h1>
    </div>
@stop

@section('scripts')

@stop