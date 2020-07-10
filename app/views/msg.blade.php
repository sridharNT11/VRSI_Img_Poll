@extends('layout')

@section('content')

   <div class="col-12 text-center">
    
    <h2 class="text-center text-danger">{{ Session::get('msg') }}</h2>
    
    <!-- <a href="{{ url('/') }}">GO BACK TO HOME</a>  -->
    
    </div>

    
@stop