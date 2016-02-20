@extends('layouts.master')

@section('content')
    <div class="Site-content">
        <div class="Filters Container"></div>
    	<div class="Filters Container"></div>
    	<div class="Container">
    	{!! Form::model($concert, ['url' => '/concert/store']) !!}
    		<div class="form-group">
				{!! Form::label('Name:') !!}
				{!! Form::text('name') !!}
			</div>
	       	<div class="form-group">
				{!! Form::label('Date') !!}
				{!! Form::text('startDate') !!}
			</div>
        	<div class="form-group">
				{!! Form::label('Address') !!}
				{!! Form::text('address') !!}
			</div>
        	<div class="form-group">
				{!! Form::label('City') !!}
				{!! Form::text('city') !!}
			</div>
        	<div class="form-group">
				{!! Form::label('Country') !!}
				{!! Form::text('country') !!}
			</div>
        	<div class="form-group">
				{!! Form::label('Description') !!}
				{!! Form::textarea('description') !!}
			</div>
			{!! Form::hidden('id') !!}
			{!! Form::submit( $concert ? 'Update Concert' : 'Add Concert') !!}

        {!! Form::close() !!}
    </div>
    </div>
@stop

@section('scripts')

@stop