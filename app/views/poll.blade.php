@extends('layout')
@section('content')
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

<div class="col-12">
   <form id="reg" name="register" action="{{ url('/poll/'.$image_poll->image_poll_id) }}" method="post">
      <input type="hidden" name="is_next" id="is_next" value="1">
      <input type="hidden" name="is_vote" id="is_vote" value="0">
      <!-- <div class="row">
         <div class="col-12 text-center">
            <h1 class="d-inline">{{ $session->session_title }}</h1>
         </div>
      </div> -->
      <div class="pb-2">
        <h1 class="d-inline">{{ $image_poll->order_no }}</h1>
        <h4 class="d-inline">/{{ $img_count }}</h4>
        &nbsp;&nbsp;
        <h4 class="mb-3 d-inline">{{ $image_poll->title }}</h4>
      </div>
      @if(isset($image_poll->image_url))
      <div class="row">
         <div class="col-12 text-center">
          <div class="w-100 bg-black">
            <img src="{{$image_poll->image_url }}" class="img-fluid mt-3 mb-3" style="height: 300px" alt=""> 
          </div>
         </div>
      </div>
      @endif
      <div class="row">
         <div class="col-12 pt-2">
            <p>{{ $image_poll->description }}</p>
         </div>
      </div>

      @if(Auth::check())
      <?php $rate = isset($user_rate->rate)?$user_rate->rate:0; ?>
        <div class="row {{ $rate >0 ?'disabled':'' }}">
         <div class="col-md-12 mb-3 text-center">

            <div class="form-group" id="rating-ability-wrapper">

                 <input type="hidden" id="selected_rating" name="selected_rating" value="{{ $rate }}" required="required">
                <h2 class="bold rating-header" style="">
                <span class="selected-rating">{{ $rate }}</span><small> / 5</small>
                </h2>
               
                <span class="h3 align-middle">
                    GOOD
                </span>
                <button type="button" class="btnrating btn btn-default btn-lg" data-attr="1" id="rating-star-1">
                    <i class="fa fa-star" aria-hidden="true"></i>
                </button>
                <button type="button" class="btnrating btn btn-default btn-lg" data-attr="2" id="rating-star-2">
                    <i class="fa fa-star" aria-hidden="true"></i>
                </button>
                <button type="button" class="btnrating btn btn-default btn-lg" data-attr="3" id="rating-star-3">
                    <i class="fa fa-star" aria-hidden="true"></i>
                </button>
                <button type="button" class="btnrating btn btn-default btn-lg" data-attr="4" id="rating-star-4">
                    <i class="fa fa-star" aria-hidden="true"></i>
                </button>
                <button type="button" class="btnrating btn btn-default btn-lg" data-attr="5" id="rating-star-5">
                    <i class="fa fa-star" aria-hidden="true"></i>
                </button>
                <span class="h3 align-middle">
                EXCELLENT</span>


            </div>


         </div>
        </div>
        <div class="row">
         <div class="col-md-12 col-sm-12 mt-3">
            <button type="submit" id="btnPrevious" class="btn btn-primary float-left">PREVIOUS</button>
            <button type="submit" id="btnNext" class="btn btn-primary float-right">NEXT</button>
         </div>
      </div>
      @else
        <div class="row {{ $qo_id >0 ?'disabled':'' }}">
           <div class="col-md-12 text-center mb-3">
           <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal">
              Login to Poll
           </button>
           </div>
        </div>
        <div class="row">
         <div class="col-md-12 col-sm-12 mt-3">
            <button type="submit" id="btnPrevious" class="btn btn-primary float-left">PREVIOUS</button>
            <button type="submit" id="btnNextdump" class="btn btn-primary float-right">NEXT</button>
         </div>
       </div>
      @endif     
      
 
     
   </form>
</div>



<!-- The Modal -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Login in</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form class="form-group">
            <!-- <h1 class="h3 mb-3 font-weight-normal" style="text-align: center"> Login in</h1> -->

            <div id="alert-success"  class="alert alert-success" role="alert" style="display: none">
              
            </div>
            <div id="alert-danger" class="alert alert-danger" role="alert" style="display: none">
              
            </div>

            <div class="input-group form-group">
              <input type="text" id="mobile" class="form-control " placeholder="Mobile Number" required="" autofocus="">
              <button id="btnsendotp" class="btn btn-success" type="button">Send OTP</button>
            </div>
            <input type="text" id="otp" class="form-control form-group" placeholder="OTP" required="">
            
            <button class="btn btn-success btn-block" id="btnlogin" type="button">Login in</button>
            <hr>
            <!-- <p>Don't have an account!</p>  -->
            <a href="https://live.vrsi.in/signup" target="_blank" class="btn btn-primary btn-block" id="btn-signup">Sign up New Account</a>
        </form>
           
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>


<script type="text/javascript">

   $( document ).ready(function() {


     $("#btnsendotp").click(function(e)
     {

      $("#alert-danger").hide();
      $("#alert-success").hide();

      var mobile = $("#mobile").val();
      if(mobile)
      {
          $("#btnsendotp").html('Please Wait..')
          $("#btnsendotp").attr('disabled',true);
          send_otp();

      }
      else
      {
        $("#alert-danger").show();
        $("#alert-danger").html("Please enter the registration mobile number");
      }

       
   
     })

     $("#btnlogin").click(function(e)
     {

      $("#alert-danger").hide();
      $("#alert-success").hide();

      var mobile = $("#mobile").val();
      var otp = $("#otp").val();
      if(mobile && otp)
      {
          $("#btnlogin").html('Please Wait..')
          $("#btnlogin").attr('disabled',true);
          $("#btnsendotp").attr('disabled',true);
          verify_otp();

      }
      else
      {
        $("#alert-danger").show();
        $("#alert-danger").html("Please enter the OTP");
      }

       
   
     })
    


    function send_otp(){
      $.ajax({
            url: baseUrl + '/api/user/send_otp',
            type: 'POST',
            dataType: 'json',
            // async: false,
            data: {'mobile' : $("#mobile").val()},
            success: function(d){
              $("#btnsendotp").html('Send OTP')
              $("#btnsendotp").attr('disabled',false);
              if(d.status == "success")
              {
                $("#alert-success").show();
                $("#alert-success").html(d.msg);
              }
              else
              {
                $("#alert-danger").show();
                $("#alert-danger").html(d.msg);
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
            data: {'mobile' : $("#mobile").val(),'otp':$("#otp").val()},
            success: function(d){
              $("#btnlogin").html('Login in')
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


        $(".btnrating").on('click',(function(e) {

          $("#btnNext").attr('disabled',false);  
  
          var previous_value = $("#selected_rating").val();

          
          var selected_value = $(this).attr("data-attr");
          $("#selected_rating").val(selected_value);
          
          $(".selected-rating").empty();
          $(".selected-rating").html(selected_value);
          
          for (i = 1; i <= selected_value; ++i) {
          $("#rating-star-"+i).toggleClass('btn-warning');
          $("#rating-star-"+i).toggleClass('btn-default');
          }
          
          for (ix = 1; ix <= previous_value; ++ix) {
          $("#rating-star-"+ix).toggleClass('btn-warning');
          $("#rating-star-"+ix).toggleClass('btn-default');
          }
        
        }));
        






     var rate = "{{ $rate }}";
     if(rate>0)
     {
        for (ix = 1; ix <= rate; ++ix) {
          $("#rating-star-"+ix).toggleClass('btn-warning');
          $("#rating-star-"+ix).toggleClass('btn-default');
          }

        $("#btnNext").attr('disabled',false);  
     }
     else
     {
        $("#btnNext").attr('disabled',true);   
     }
     
   
     
   
     $("#btnPrevious").click(function(e)
     {
       $("#is_next").val(0)
       // $("form[name='register']").attr('action',$(this).attr('data-url'))
       // $("form[name='register']").submit();
   
     })

      $("#btnNext").click(function(e)
     {
       $("#btnNext").html('Please Wait...');
       $("#is_next").val(1)
        $("#is_vote").val(1)
       // $("form[name='register']").attr('action',$(this).attr('data-url'))
       // $("form[name='register']").submit();
     })

      //btn next dump for with login 
     $("#btnNextdump").click(function(e)
     {
        $("#btnNextdump").html('Please Wait...');
       $("#is_next").val(1)
       // $("form[name='register']").attr('action',$(this).attr('data-url'))
       // $("form[name='register']").submit();
     })
   });




</script>
@stop