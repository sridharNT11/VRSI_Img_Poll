@extends('layout')

@section('content')

<style type="text/css">
    #message
    {
        color:red;
    }
</style>
<script async src="https://www.googletagmanager.com/gtag/js?id=G-Y6H888QVV9"></script>
<div class="container content"> 
 <div class="row">
    <div class="col-12"> <a href="{{ url('/archive') }}"><img src="{{ asset('images/archive.png') }}" alt="Archive" class="float-right"></a> </div>
  </div>
</div>
   <div class="col-12">
    <h1 class="text-center" id="message"> Thank you for your interest in Brain Teasers.  This session is closed for participation now.  Watch out this space for the correct answers along with the list of participants who got the correct answers. <br />
        See you on Sunday at 9 am with a new round of exciting quiz. <br /></h1>    
    
    </div>
    <div class="container content">
	<div class="row align-items-center">
	<div class="col-12">	
		<br> <img src="{{ asset('images/photo2.png') }}" alt="Logo" height="100" class="mx-auto d-block mb-5">
      
		
    </div>
		</div>
</div>
    
@stop