@extends('layout')

@section('content')

<style type="text/css">
  #date
  {
    color:#3366cc;
    font-weight: bold;
    font-size: 1.25rem;
   
  }
    #session
  {
    color:#3366cc;
    font-weight: bold;

  }
  #heading
  {
    color:red;
    font-weight: bold;
    font-size: 2.25rem;

  }
</style>


<div class="col-md-7 col-sm-12 offset-md-3">
    <h1 class="mb-3" id="heading"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ARCHIVE</h1>
    <form id="reg" name="register" action="" method="post">
  <div class="form-group">
    <label for="date" id="date">1.&nbsp;06/Sep/2019 &nbsp;</label>
      <label for="inputFullName">&nbsp;- &nbsp;</label>
        <label for="session" id="session"><h5><a href="{{ url('cataract_one') }}" target="_blank" id="session">  Cataract </a></h5></label>
  </div>
   <div class="form-group">
    <label for="date" id="date">2.&nbsp;15/Sep/2019 &nbsp;</label>
      <label for="inputFullName"> &nbsp; - &nbsp; </label>
        <label for="session" id="session"><h5><a href="{{ url('cornea') }}" target="_blank" id="session">   Cornea </a></h5></label>
  </div>

   
   <div class="form-group">
    <label for="date" id="date">3.&nbsp;22/Sep/2019 &nbsp;</label>
      <label for="inputFullName"> &nbsp; - &nbsp; </label>
        <label for="session" id="session"><h5><a href="{{ url('glaucoma_one') }}" target="_blank" id="session">   Glaucoma </a></h5></label>
  </div>
   <div class="form-group">
    <label for="date" id="date">4.&nbsp; 29/Sep/2019 &nbsp; </label>
      <label for="inputFullName">&nbsp; - &nbsp; </label>
        <label for="session" id="session"> <h5><a href="{{ url('retina') }}" target="_blank" id="session"> Retina </a></h5></label>
  </div>
   <div class="form-group">
    <label for="date" id="date">5.&nbsp; 06/Oct/2019 &nbsp; </label>
      <label for="inputFullName">&nbsp; - &nbsp;  </label>
        <label for="session" id="session"><h5><a href="{{ url('cataract') }}" target="_blank" id="session">   Cataract </a></h5></label>
  </div>
  <div class="form-group">
    <label for="date" id="date">6.&nbsp; 13/Oct/2019 &nbsp; </label>
      <label for="inputFullName">&nbsp; - &nbsp; </label>
        <label for="session" id="session"> <h5><a href="{{ url('dusshera_special') }}" target="_blank" id="session">   Dusshera Special </a></h5></label>
  </div>
   <div class="form-group">
    <label for="date" id="date">7.&nbsp; 20/Oct/2019 &nbsp;</label>
      <label for="inputFullName">  &nbsp; - &nbsp;  </label>
        <label for="session" id="session"> <h5><a href="{{ url('pediatric_ophthalmology') }}" target="_blank" id="session">  Pediatric Ophthalmology </a></h5></label>
  </div>
   
   <div class="form-group">
    <label for="date" id="date">8.&nbsp; 27/Oct/2019 &nbsp;</label>
      <label for="inputFullName">&nbsp; - &nbsp; </label>
        <label for="session" id="session"><h5><a href="{{ url('diwali_quiz') }}" target="_blank" id="session" class="post-header text-right">   Diwali Quiz </a></h5></label>
  </div>
  <div class="form-group">
    <label for="date" id="date">9.&nbsp; 03/Nov/2019 &nbsp;</label>
      <label for="inputFullName">&nbsp; - &nbsp; </label>
        <label for="session" id="session"><h5><a href="{{ url('glaucoma_session') }}" target="_blank" id="session" class="post-header text-right">   Glaucoma </a></h5></label>
  </div>
  <div class="form-group">
    <label for="date" id="date">10.&nbsp; 10/Nov/2019 &nbsp;</label>
      <label for="inputFullName">&nbsp; - &nbsp; </label>
        <label for="session" id="session"><h5><a href="{{ url('cataract_three_session') }}" target="_blank" id="session" class="post-header text-right">   Cataract </a></h5></label>
  </div>
  <div class="form-group">
    <label for="date" id="date">11.&nbsp; 17/Nov/2019 &nbsp;</label>
      <label for="inputFullName">&nbsp; - &nbsp; </label>
        <label for="session" id="session"><h5><a href="{{ url('retina_session') }}" target="_blank" id="session" class="post-header text-right">   Retina </a></h5></label>
  </div>
   <div class="form-group">
    <label for="date" id="date">12.&nbsp; 24/Nov/2019 &nbsp;</label>
      <label for="inputFullName">&nbsp; - &nbsp; </label>
        <label for="session" id="session"><h5><a href="{{ url('word_roots_session') }}" target="_blank" id="session" class="post-header text-right">   Word Roots </a></h5></label>
  </div> 
   <div class="form-group">
    <label for="date" id="date">13.&nbsp; 01/Dec/2019 &nbsp;</label>
      <label for="inputFullName">&nbsp; - &nbsp; </label>
        <label for="session" id="session"><h5><a href="{{ url('named_signs_session') }}" target="_blank" id="session" class="post-header text-right">   Named Signs </a></h5></label>
  </div> 
    <div class="form-group">
        <label for="date" id="date">14.&nbsp; 08/Dec/2019 &nbsp;</label>
          <label for="inputFullName">&nbsp; - &nbsp; </label>
            <label for="session" id="session"><h5><a href="{{ url('scientists_ophthalmology_session') }}" target="_blank" id="session" class="post-header text-right">   Scientists in ophthalmology  </a></h5></label>
      </div> 
       <div class="form-group">
        <label for="date" id="date">15.&nbsp; 15/Dec/2019 &nbsp;</label>
          <label for="inputFullName">&nbsp; - &nbsp; </label>
            <label for="session" id="session"><h5><a href="{{ url('ophthalmology_eponyms_session') }}" target="_blank" id="session" class="post-header text-right">   Ophthalmology Eponyms  </a></h5></label>
      </div> 
       <div class="form-group">
        <label for="date" id="date">16.&nbsp; 22/Dec/2019 &nbsp;</label>
          <label for="inputFullName">&nbsp; - &nbsp; </label>
            <label for="session" id="session"><h5><a href="{{ url('oct_session') }}" target="_blank" id="session" class="post-header text-right">   OCT  </a></h5></label>
      </div> 
       <div class="form-group">
        <label for="date" id="date">17.&nbsp; 29/Dec/2019 &nbsp;</label>
          <label for="inputFullName">&nbsp; - &nbsp; </label>
            <label for="session" id="session"><h5><a href="{{ url('visual_fields_session') }}" target="_blank" id="session" class="post-header text-right">   Visual Fields  </a></h5></label>
      </div> 
       <div class="form-group">
        <label for="date" id="date">18.&nbsp; 05/Jan/2020 &nbsp;</label>
          <label for="inputFullName">&nbsp; - &nbsp; </label>
            <label for="session" id="session"><h5><a href="{{ url('cataract_session') }}" target="_blank" id="session" class="post-header text-right">   Cataract  </a></h5></label>
      </div> 
      <div class="form-group">
        <label for="date" id="date">19.&nbsp; 12/Jan/2020 &nbsp;</label>
          <label for="inputFullName">&nbsp; - &nbsp; </label>
            <label for="session" id="session"><h5><a href="{{ url('retina_session_jan20') }}" target="_blank" id="session" class="post-header text-right">   Retina  </a></h5></label>
      </div> 
       <div class="form-group">
        <label for="date" id="date">20.&nbsp; 19/Jan/2020 &nbsp;</label>
          <label for="inputFullName">&nbsp; - &nbsp; </label>
            <label for="session" id="session"><h5><a href="{{ url('cornea_ses_archive') }}" target="_blank" id="session" class="post-header text-right">   Cornea  </a></h5></label>
      </div> 
      
       <div class="form-group">
        <label for="date" id="date">21.&nbsp; 26/Jan/2020 &nbsp;</label>
          <label for="inputFullName">&nbsp; - &nbsp; </label>
            <label for="session" id="session"><h5><a href="{{ url('back_to_basics_archive') }}" target="_blank" id="session" class="post-header text-right">   Back To Basics  </a></h5></label>
      </div> 
      
    {{--  <div class="form-group">
        <label for="date" id="date">22.&nbsp;09/Feb/2020 &nbsp;</label>
          <label for="inputFullName">&nbsp; - &nbsp; </label>
            <label for="session" id="session"><h5><a href="{{ url('ophthalmic_savoury_archive') }}" target="_blank" id="session" class="post-header text-right">   Ophthalmic Savoury  </a></h5></label>
      </div> --}}


  
  <div class="row">
   <div class="col-md-12 col-sm-12 mt-4">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<button type="button" id="index" class="btn btn-primary float-center" onclick="location.href='{{URL('/')}}'"> <i class="fa fa-plus"></i> Previous</button>
   </div>
 </div>


</form>
</div>
@stop