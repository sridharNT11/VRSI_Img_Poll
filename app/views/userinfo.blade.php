@extends('layout')

@section('content')

 <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-Y6H888QVV9"></script>
<script>
 window.dataLayer = window.dataLayer || [];
 function gtag(){dataLayer.push(arguments);}
 gtag('js', new Date());

 gtag('config', 'G-Y6H888QVV9');
</script>

<div class="col-md-6 col-sm-12 offset-md-3">
    <h4 class="mb-3">Please enter your details</h4>
    <form id="reg" name="register" action="{{ url('user_info/'.Helper::encrypt($user->user_id)) }}" method="post">

<input type="hidden" name="is_next" id="is_next" value="1">

      <div class="form-group">
    <label for="inputFullName">Full Name</label>
    <input type="text" class="form-control" id="inputFullName" name="name" placeholder="Name" value="{{ Input::old('name') !==null ? Input::old('name'): $user->name }}">
      <label class="red"> {{ $errors->first('name') }}</label>
  </div>
  <div class="form-group">
    <label for="inputEmail">Email</label>
    <input type="email" class="form-control" id="inputEmail" name="email" placeholder="Email Address" value="{{Input::old('email') !== null ?Input::old('email'): $user->email}}" >
     <label class="red"> {{ $errors->first('email') }}</label>
  </div>
    <div class="form-group">
    <label for="inputMobile">Mobile</label>
    <input type="text" class="form-control" id="inputMobile" name="mobile" placeholder="mobile number" value="{{Input::old('mobile') !==null ?Input::old('mobile'): $user->mobile}}" >
     <label class="red"> {{ $errors->first('mobile') }}</label>
  </div>
  <div class="form-group">
     <label for="inputMobile">Date of Birth</label>
        <div class='input-group date' id='dobDateTimePicker'>
                {{ Form::text('dob',Helper::fromDBToDDMMYYYY($user->dob), array('id' => 'dob', 'class' => 'form-control req dt', 'maxlength' => '10','placeholder' => 'DD/MM/YYYY'))}}    
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
        </div>
   
     <label class="red"> {{ $errors->first('dob') }}</label>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputCity">City</label>
      <input type="text" class="form-control" id="inputCity" name="city" placeholder="City" value="{{Input::old('city') !==null ? Input::old('city'): $user->city}}" >
      <label class="red"> {{ $errors->first('city') }}</label>
    </div>
    <div class="form-group col-md-6">
      <label for="inputState">State</label>
      <input type="text" class="form-control" id="inputState" name="state" placeholder="State" value="{{ Input::old('state') !==null ? Input::old('state'): $user->state}}" >
      <label class="red"> {{ $errors->first('state') }}</label>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="pg_student">Are you a Post Graduate?</label> <label id="is_pg_student-error" class="error" for="is_pg_student"></label>
      <br/>
      <label> <input type="radio" name="is_pg_student" value="1"  id="Yes" {{ ( Input::old('is_pg_student') !== null ? (Input::old('is_pg_student') == "1"? 'checked="checked"':'') : ($user->is_pg_student=="1" ?'checked="checked"':'')) }}> Yes</label>
      <label><input type="radio" name="is_pg_student" value="0"  id="No" {{ ( Input::old('is_pg_student') !== null ? (Input::old('is_pg_student') == "0"? 'checked="checked"':'') : ($user->is_pg_student=="0" ?'checked="checked"':'')) }} >  No </label>
    </div>
  </div>

  <!--<div class="row">-->
  <!--  <div class="col-md-6 mt-3">-->
  <!--  <button type="submit" id="btnPrevious" class="btn btn-primary float-left">PREVIOUS</button>-->
  <!--  </div>-->
  <!--  <div class="col-md-6 mt-3">-->
  <!--  <button type="submit" id="btnNext" class="btn btn-primary float-right">NEXT</button>-->
  <!--  </div>-->
  <!--</div>-->
  <div class="row">
   <div class="col-md-12 col-sm-12 mt-3">
   <button type="submit" id="btnPrevious" class="btn btn-primary float-left">PREVIOUS</button>
     
   <button type="submit" id="btnNext" class="btn btn-primary float-right">NEXT</button>
   </div>
 </div>
</form>
</div>

<script type="text/javascript">

  $( document ).ready(function() {

   validation();

    $("#btnPrevious").click(function(e)
    {
      $("#is_next").val(0)
      // $("form[name='register']").attr('action',$(this).attr('data-url'))
      // $("form[name='register']").submit();

    })
     $("#btnNext").click(function(e)
    {
      $("#is_next").val(1)
      // $("form[name='register']").attr('action',$(this).attr('data-url'))
      // $("form[name='register']").submit();
    })
  });


    function validation()
    {
        $("#reg").validate({
                    //ignore: "",
                    rules: {    
                      name: {                      
                        required: true
                      },      
                      mobile: {
                        required: true                      
                      },
                      email: {
                        required: true                      
                      },
                      city: {
                        required: true                      
                      },
                      state: {
                        required: true                      
                      },
                      dob: {
                        required: true                      
                      },
                      is_pg_student: {
                        required: true                      
                      },
                      // hdnPAId: {
                      //   required: true,
                      //   number:true,
                      //   min:1              
                      // }
                    },
                    messages:{
                      //hdnPAId :"Please, search and select an Presenting Author Details"
                    }                
              });
          
    }

</script>
@stop