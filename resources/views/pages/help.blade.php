@extends('layouts.master')

@section('content')
    <div class="Site-content">
        <div class="Container">
            <h2>FAQ</h2>
            <h3>Having trouble logging in</h3>
            The loginfunction uses the facebook as useraccount provider. If you denied our website access to your facebook info, you can't login.
            <h3>How do I delete my account?</h3>
            We don't create accounts, we rely on facebook for your info.
            <h3>I can’t find the answer to my question.</h3>
            If you’re not finding the answer to your question here, send us an email.
        </div>
    </div>
    @section ('footer')
        @include ('footer')
    @show
@stop

@section('scripts')
@stop