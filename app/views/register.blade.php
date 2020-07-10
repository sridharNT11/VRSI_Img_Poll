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
      <h4 class="mb-3">Please enter your mobile number:</h4>
    <form id="reg" name="register" action="{{ url('login') }}" method="post">
      <div class="form-group">
    <!--<label for="inputFullName">Mobile Number</label>-->
    <input type="text" class="form-control" id="mobile" name="mobile" placeholder="mobile number" value="{{ isset($user) ? $user->mobile:''  }}" >
      <label class="red"> {{ $errors->first('mobile') }}</label>
  </div>
    
  <button type="submit" class="btn btn-primary float-right">NEXT</button>
</form>
</div>


<script>
  // Wait for the DOM to be ready
$(function() {
  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
  $("form[name='register']").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
      mobile: 
      {
        required: true, 
        minlength: 10        
      },
    },
    // Specify validation error messages
    messages: {
              mobile :
              {
                required:  "The mobile may only contain letters and numbers.",
              }
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }
  });
});
</script>
@stop