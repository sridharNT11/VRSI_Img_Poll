@extends('layout')
@section('content')
<div class="col-12">
  <h4>Update Your Profile Infromation</h4>
  <hr/>
   <form id="reg" name="register" action="{{ url('/profile') }}" method="post">
            <div class="form-group">
              <label>Prefix:<span class="text-danger">*</span></label>
               {{ Form::select('prefix',array(''=>'--select--', 'Dr' => 'Dr', 'Mr' => 'Mr', 'Mrs' => 'Mrs', 'Ms' => 'Ms','Prof'=>'Prof'),$user->prefix,array("id"=>"prefix","class"=>"form-control prefix"))}}
               <label class="red"> {{ $errors->first('prefix') }}</label>
            </div>
            
            <div class="form-group">
              <label>Full Name:<span class="text-danger">*</span></label>
              <input type="text" id="full_name"  name="full_name" class="form-control" placeholder="Full Name" required="" autofocus="" value="{{ Input::old('full_name') !==null ? Input::old('full_name'): $user->full_name }}">
              <label class="red"> {{ $errors->first('full_name') }}</label>
            </div>
            <div class="form-group">
                <label>Email Id:<span class="text-danger">*</span></label>
              <input type="text" id="email" name ="email" class="form-control " placeholder="Email Id" required="" autofocus=""
              value="{{ Input::old('email') !==null ? Input::old('email'): $user->email }}" >
              <label class="red"> {{ $errors->first('email') }}</label>
            </div>
            <div class="form-group">
              <label>Mobile:<span class="text-danger">*</span></label>
              <input type="text" id="mobile" name="mobile" class="form-control " placeholder="Mobile Number" required="" autofocus=""
              value="{{ Input::old('mobile') !==null ? Input::old('mobile'): $user->mobile }}" 
              >
              <label class="red"> {{ $errors->first('mobile') }}</label>
            </div>
            <div class="form-group">
              <label>City:<span class="text-danger">*</span></label>
              <input type="text" id="city" name="city" class="form-control " placeholder="City" required="" autofocus=""
              value="{{ Input::old('city') !==null ? Input::old('city'): $user->city }}">
              <label class="red"> {{ $errors->first('city') }}</label>
            </div>
            <div class="form-group">
              <label>State:<span class="text-danger">*</span></label>
              <input type="text" id="state" name="state" class="form-control " placeholder="State" required="" autofocus=""
              value="{{ Input::old('state') !==null ? Input::old('state'): $user->state }}">
              <label class="red"> {{ $errors->first('state') }}</label>
            </div>
            <div class="form-group">
              <label>Affiliation:<span class="text-danger">*</span></label>
              <input type="text" id="affiliation" name="affiliation" class="form-control" placeholder="Please Enter your Affiliation"
               required="" autofocus=""
               value="{{ Input::old('affiliation') !==null ? Input::old('affiliation'): $user->affiliation }}">
               <label class="red"> {{ $errors->first('affiliation') }}</label>
            </div>

</div>
<div class="col-12 text-center">
  <a  href="{{ url('/') }}" class="btn btn-warning" id="btnlogin">Back</a>
<button class="btn btn-primary" id="btnSubmit" type="Submit">Submit</button>
</div>

<script type="text/javascript">

  $(document).ready(function() {

      $("#btnSubmit").click(function(e)
      {
   
      });
     
      $("#reg").validate({
        rules: {                        
           prefix: {
              required: true
            },          
            full_name:{
              required: true
            },    
            email:{
              required: true,
              email:true,
            },    
            mobile:{
              required: true,
            },    
            city:{
              required: true
            },    
            state:{
              required: true
            },    
            affiliation:{
              required: true
            },    
          
          },
          messages: {
               
                
          },                  
          invalidHandler: function(form, validator) {

              if (!validator.numberOfInvalids())
                  return;
              try {
                $('html, body').animate({
                    scrollTop: $(validator.errorList[0].element).offset().top-200
                }, 1000);
              }
              catch(err) {
                
              }

          }
        });

  });


</script>
@stop