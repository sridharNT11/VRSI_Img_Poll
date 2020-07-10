@extends('layout')

@section('content')

   <div class="col-12 text-center">
    
    <img src="{{ asset('images/success.png') }}" alt="Success" class="mx-auto d-block mb-5" >
    <h2 class="text-center text-success">{{ Session::get('msg') }}</h2>
    
    <!-- <a href="{{ url('/') }}">GO BACK TO HOME</a>  -->
    
    </div>

    
@stop