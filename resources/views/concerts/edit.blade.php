@extends('layouts.master')

@section('content')
    <div>
    	{!! Form::open(array('url' => 'concert/store')) !!}
    		<div class="form-group">
				{!! Form::label('Name:') !!}
				{!! Form::text('name', {{ $concert ? $concert['_source']['name'] }}, ['class' => 'form-control']) !!}
			</div>
        	<div class="form-group">
				{!! Form::label('Date') !!}
				{!! Form::text('name', {{ $concert ? $concert['_source']['date'] }}, ['class' => 'form-control']) !!}
			</div>
        	<div class="form-group">
				{!! Form::label('Address') !!}
				{!! Form::text('name', {{ $concert ? $concert['_source']['address'] }}, ['class' => 'form-control']) !!}
			</div>
        	<div class="form-group">
				{!! Form::label('City') !!}
				{!! Form::text('name', {{ $concert ? $concert['_source']['city'] }}, ['class' => 'form-control']) !!}
			</div>
        	<div class="form-group">
				{!! Form::label('Country') !!}
				{!! Form::text('name', {{ $concert ? $concert['_source']['country'] }}, ['class' => 'form-control']) !!}
			</div>
        	<div class="form-group">
				{!! Form::label('Description') !!}
				{!! Form::text('name', {{ $concert ? $concert['_source']['description'] }}, ['class' => 'form-control']) !!}
			</div>

        {!! Form::close() !!}
    </div>
@stop

@section('scripts')

@stop