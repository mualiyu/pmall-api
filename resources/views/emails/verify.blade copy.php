@extends('layouts.mail')

@section('content')

<h2>Welcome to Pmall</h2>
{{-- # Email Verification --}}

{{-- Thank you for signing up. --}}
{{-- Use this link to verify your email <a href="{{url('/tokens?token='.$pin)}}">{{url('/tokens?token='.$pin)}}</a> --}}
@if (array_key_exists('store_name', $mailData))
Your Store Name is {{$store_name}}
@endif
<br>
Username/Email: {{$mailData['email']}}
<br>
Password: {{$mailData['pass']}}


Thank you for registering with Pmall.<br>
{{ config('app.name') }}

@endsection


