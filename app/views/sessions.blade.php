@extends('layout')

@section('content')

<style>
.mb-3 {
    text-align: center;
}
#ans
{
  color:red;
}
</style>

      <h1 class="mb-3" id="heading"><b>Cataract Session - Answers</b></h1>
   <form id="reg" name="register" action="{{ url('session_details/')}}" method="post">
      <div class="form-group">
 <h1 class="d-inline"></h1>
          <h3>Q1. Glare is associated with</h3>
          <h3 id="ans" >Ans : C) Posterior subcapsular cataract</h3>
          <br/>

          <h3>Q2. Types of PCO are all except :</h3>
          <h3 id="ans"> Ans: D) Glaucomflecken</h3>
           <br/>
          <h3>Q3. Organism associated with post YAG cap endophthalmitis is :</h3>
          <h3 id="ans">Ans: C) P. acnes</h3>

          <br/>
          <h3>Q4. Focal infarcts on anterior lens capsule found in acute angle closure glaucoma are called : </h3>
          <h3 id="ans">Ans: B) Glaucomflecken</h3>

          <br/>

          <h3>Q5. This cataract is also called as :</h3>
          <h3 id="ans">Ans: C) Cataracta punctata caerulea</h3>


  </div>
      <button type="button" id="add" class="btn btn-primary float-right" onclick="location.href='{{URL('users_answers')}}'"><i class="fa fa-plus"></i> Click here to view the list of participants who got all correct!</button>
  <!-- <button type="submit" class="btn btn-primary float-right">NEXT</button> -->
</form>




@stop