@extends('layouts.master')

@section('content')
    <div class="Site-content">
    	<div class="Container">
        	<h2> Add your event </h2>
        	{!! Form::model($concert, ['url' => '/concert/store', 'class'=> 'Event-form']) !!}
        		<div class="Form-group">
    				{!! Form::label('Name:') !!}
    				{!! Form::text('name') !!}
    			</div>
    	       	<div class="Form-group">
    				{!! Form::label('Date:') !!}
    				{!! Form::text('startDate') !!}
    			</div>
            	<div class="Form-group">
    				{!! Form::label('Address:') !!}
    				{!! Form::text('address') !!}
    			</div>
            	<div class="Form-group">
    				{!! Form::label('City:') !!}
    				{!! Form::text('city') !!}
    			</div>
            	<div class="Form-group">
    				{!! Form::label('Country:') !!}
    				{!! Form::text('country') !!}
    			</div>
            	<div class="Form-group">
    				{!! Form::label('Description:') !!}
    				{!! Form::textarea('description') !!}
    			</div>
    			{!! Form::hidden('id') !!}
    			{!! Form::submit( $concert ? 'Update Concert' : 'Add Concert', ['class'=>'Button Button--addEvent']) !!}
                <div class="u-clearfix"></div>
            {!! Form::close() !!}
        </div>
    </div>
    @section ('footer')
        @include ('footer')
    @show
@stop

@section('scripts')
@stop