@extends('layout')

@section('content')

<div class="row p-5 h-100">
	<div class="col-lg-12 col-sm-12">
      <h5 class="text-primary " >Header</h5>
      <ol class="text-secondery pl-5">
        <li>text 1</li>
        <li>text 2 </li>
        <li>text 2</li>
        <li>text 2</li>
        <li>text 2</li>
        <li>text 2</li>
      </ol><br/>
		<div class="col-12 text-right">
		<a href="{{ url('poll') }}"class="btn btn-primary text-center">NEXT</a>
			</div>
	   </div>
	
</div>

@stop