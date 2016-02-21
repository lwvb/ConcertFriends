@extends('layouts.master')

@section('content')
    <div class="Site-content">
        <div class="Container">
            <h2>FAQ</h2>
            <h3>Having trouble logging in</h3>
            If you're having trouble logging in because you can't remember your password, try using our Password Reset helper. 
            If this isn't working for you, send us an email and we'll do our best to help you retrieving your password. Please remember to tell us your username, your account's email address and your date of birth for verification, to help prevent a fraudulent reset password request.
            Should you have forgotten your username, please tell us the email address you've entered in your profile settings and we can help looking your name up.
            <h3>How do I delete my account?</h3>
            You can delete your account on the Account page within your profile settings.
            <h3>How do I change or reset my password?</h3>
            If you are already logged in, you can change your password by visiting the Account page within your profile settings.
            If you need to reset your password, you can do so here: 
            <h3>I can’t find the answer to my question.</h3>
            If you’re not finding the answer to your question here, you send us an email.
        </div>
    </div>
    @section ('footer')
        @include ('footer')
    @show
@stop

@section('scripts')
@stop