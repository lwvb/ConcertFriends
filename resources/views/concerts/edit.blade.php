@extends('layouts.master')

@section('headermeta')
<link href="/css/picker.css" rel="stylesheet" type="text/css">
@stop

@section('content')
    <div class="Site-content">
    	<div class="Container">
        	@if (count($errors) > 0)
    		    <div class="alert alert-danger">
    		        <h3>Something went wrong</h3>
    		        <ul>
    		            @foreach ($errors->all() as $error)
    		                <li>{{ $error }}</li>
    		            @endforeach
    		        </ul>
    		    </div>
    		@endif
        	<h2> Add your event </h2>
        	{!! Form::model($concert, ['url' => '/concert/store', 'class'=> 'Event-form']) !!}
        		<div class="Form-group">
    				{!! Form::label('Name:') !!}
    				{!! Form::text('name') !!}
    			</div>
    	       	<div class="Form-group">
    			    {!! Form::label('Date:') !!}
                    {!! Form::text('date', null, ['class' => 'datepicker']) !!}
                </div>
                <div class="Form-group">
                    {!! Form::label('Starttime:') !!}
                    {!! Form::text('time', null, ['class' => 'timepicker']) !!}
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
<script>
$(function() {
    $('.datepicker').pickadate({
        min: new Date(),
        format: 'yyyy-mm-dd',
        formatSubmit: 'yyyy-mm-dd'
    });
    $('.timepicker').pickatime({
        format: 'HH:i',
        formatLabel: 'HH:i',
        formatSubmit: 'HH:i',
        interval: 15
    });
});
</script>
<script src="/js/all.js"></script>
@stop