@extends('layouts.master')

@section('content')
    <div>
        {{ $concert['_source']['name'] }}
    </div>
@stop

@section('scripts')

@stop