@extends('layout')

@section('content')
<div>
<!-- The Modal -->
<div >
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Login</h4>
        <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form class="form-group">
          <input type="hidden" name="hdnuserId" id="hdnuserId" value="0">
           <div id="alert-success"  class="alert alert-success" role="alert" style="display: none">
              
            </div>
            <div id="alert-danger" class="alert alert-danger" role="alert" style="display: none">
              
            </div>
            <!-- <h1 class="h3 mb-3 font-weight-normal" style="text-align: center"> Login in</h1> -->
            <div id="Login">
                        <div id="alert-warning" class="alert alert-warning" role="alert">
                          Please enter your email id or mobile number here to get an OTP.
                        </div>

                        <div class="form-group">
                          <label>Email Id:</label>
                          <input type="text" id="email" class="form-control " placeholder="Email Id" required="" autofocus="">
                        </div>
                        <div class="form-group text-center">
                          <label class="text-dark">Or</label>
                        </div>
                        <div class="form-group">
                          <label>Mobile Number:</label>
                          <input type="text" id="mobile" class="form-control " placeholder="Mobile Number" required="" autofocus="">
                        </div>
                        
                        <button class="btn btn-success btn-block" id="btnlogin" type="button">Login</button>
            </div>
            <div id="OTPVerfy" style="display: none">
                        <div class="form-group">
                          <label>OTP:</label>
                          <input type="text" id="otp" class="form-control " placeholder="OTP" required="" autofocus="">
                        </div>
                        <button class="btn btn-success btn-block" id="btnOTPVerify" type="button">Verify OTP</button>
                        <button class="btn btn-warning btn-block" id="btnRetryOTP" type="button">Resend OTP</button>
            </div>
            <hr>
            <!--<p>The OTP is valid for 10 mins.</p>-->
            <p> If you do not get an OTP to login,  please write to <a href="mailto:support@VRSI.in">support@VRSI.in</a> for assistance.</p>
           <!--  <a href="https://live.vrsi.in/signup" target="_blank" class="btn btn-primary btn-block" id="btn-signup">Sign up New Account</a> -->
        </form>
      </div>

      <!-- Modal footer -->
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div> -->

    </div>
  </div>
</div>

<script type="text/javascript">

   $( document ).ready(function() {

    
    $("#btnRetryOTP").click(function(e)
     {
        $("#alert-danger").hide();
        $("#alert-success").hide();
        $("#btnlogin").html('Login')
        $("#btnlogin").attr('disabled',false);
        $("#OTPVerfy").hide();
        $("#Login").show();

     });


     $("#btnlogin").click(function(e)
     {

      $("#alert-danger").hide();
      $("#alert-success").hide();

      var mobile = $("#mobile").val();
      var email = $("#email").val();
      if(email)
      {
          if(!isEmail(email))
          {
            $("#alert-danger").show();
            $("#alert-danger").html("Please enter the valid Email Id");
            return false;
          }
      }

      if(mobile)
      {
          
            var filter = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;

            if (filter.test(mobile)) {
              if(mobile.length>=10){
                   var validate = true;
              } else {
                  $("#alert-danger").show();
                  $("#alert-danger").html("Please enter the valid mobile number");
                  return false;
              }
            }
            else {
                  $("#alert-danger").show();
                  $("#alert-danger").html("Please enter the valid mobile number");
                  return false;
            }
       }     


      // var otp = $("#otp").val();
      if(mobile || email)
      {
          $("#btnlogin").html('Please Wait..')
          $("#btnlogin").attr('disabled',true);
          // $("#btnsendotp").attr('disabled',true);
          send_otp();
      }
      else
      {
        $("#alert-danger").show();
        $("#alert-danger").html("Please enter the Mobile Number Or Email Id");
      }
   
     })

     $("#btnOTPVerify").click(function(e)
     {

      $("#alert-danger").hide();
      $("#alert-success").hide();

      var otp = $("#otp").val();
      if(otp)
      {
          $("#btnOTPVerify").html('Please Wait..')
          $("#btnOTPVerify").attr('disabled',true);
          verify_otp();

      }
      else
      {
        $("#alert-danger").show();
        $("#alert-danger").html("Please enter OTP");
      }
   
     })
   
   });


function send_otp(){
      $.ajax({
            url: baseUrl + '/api/user/send_otp',
            type: 'POST',
            dataType: 'json',
            // async: false,
            data: {'mobile' : $("#mobile").val(),'email':$("#email").val()},
            success: function(d){
              $("#btnsendotp").html('Send OTP')
              $("#btnsendotp").attr('disabled',false);
              if(d.status == "success")
              {
                $("#hdnuserId").val(d.user_id);
                $("#alert-success").show();
                $("#alert-success").html(d.msg);
                $("#OTPVerfy").show();
                $("#Login").hide();
              }
              else
              {
                $("#alert-danger").show();
                $("#alert-danger").html(d.msg);
                $("#btnlogin").html('Login')
                $("#btnlogin").attr('disabled',false);
              }
            }            
        })
    }
  

    function verify_otp(){
      $.ajax({
            url: baseUrl + '/api/user/verify_otp',
            type: 'POST',
            dataType: 'json',
            async: false,
            data: {'user_id' : $("#hdnuserId").val(),'otp':$("#otp").val()},
            success: function(d){
              $("#btnlogin").html('Login')
              $("#btnlogin").attr('disabled',false);
              $("#btnsendotp").attr('disabled',false);
              if(d.status == "success")
              {
                $("#alert-success").show();
                $("#alert-success").html(d.msg);

                location.reload();
              }
              else
              {
                $("#alert-danger").show();
                $("#alert-danger").html(d.msg);
              }
            }            
        })
      }


function isEmail(email) {
          var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
          return regex.test(email);
        }

</script>

@stop