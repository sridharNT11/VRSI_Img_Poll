@extends('layout')

@section('content')

<style type="text/css">
    #archive
    {
        text-decoration: underline;
        color: #039;
    }
</style>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-Y6H888QVV9"></script>
<script>
 window.dataLayer = window.dataLayer || [];
 function gtag(){dataLayer.push(arguments);}
 gtag('js', new Date());

 gtag('config', 'G-Y6H888QVV9');
</script>

@if($session->session_type != CustomClass::$SESSION_RANDOM)

   <div class="col-12">
      
    <img src="{{ asset('images/success.png') }}" alt="Success" class="mx-auto d-block mb-5" >
    <h1 class="text-center"> Wonderful!<br /><br />

It was nice to have you here. The answers and the names of the participants who answered correctly will be published next sunday. Meanwhile , check out the <a href="{{ url('/archive') }}" id="archive">Archive</a> section to have a glimpse of the past quiz sessions.Until then, See ya!<br/></h1>
    </div>
    @else
    <div class="col-12">
      
    <img src="{{ asset('images/success.png') }}" alt="Success" class="mx-auto d-block mb-5" >
    <h1 class="text-center"> Great!<br /><br />

The 30 questions, would have tested your grey cells! <br/>
Watch out for the correct answers and the toppers of the Mega Quiz after 2nd Feb. <br/></h1>
    </div>
@endif
     <div class="container content">
	<div class="row align-items-center">
	<div class="col-12">	
		<br> <img src="{{ asset('images/photo2.png') }}" alt="Logo" height="100" class="mx-auto d-block mb-5">
      
		
    </div>
		</div>
</div>
@stop