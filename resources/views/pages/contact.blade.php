@extends('layouts.master')

@section('content')
    <div class="Site-content">
        <div class="Container">
            <h2>Contact</h2>
            <h3>Support Questions</h3>
            Please visit our help section for your support issues. Don’t forget to check the FAQ and the support forums where you can get help with your questions.
            <h3>General Business Enquiries</h3>
            For general business enquires please email ...<br>
            Note: Please don't send support questions here, they won't be answered.
            <h3>Postal Address</h3>
            Team A headoffice <br>
            Random street 213<br>
            Hilversum<br>
            Company Number: 4569646 <br>
            Registered in: The Netherlands<br>
            VAT registration number: 830 24<br>
        </div>
    </div>
    @section ('footer')
        @include ('footer')
    @show
@stop

@section('scripts')
@stop