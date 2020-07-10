<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>VRSI</title>

<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

<link href="{{ asset('css/style.css') }}" rel="stylesheet">


<script src="{{ asset('/js/jquery.min.js') }}"></script>

<script src="{{ asset('/js/popper.min.js') }}"></script>
<script src="{{ asset('/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/js/jquery.validate.js') }}"></script>

<script type="text/javascript">
  var baseUrl="{{ url('/') }}";
</script>
<noscript>
    <style type="text/css">
        .container {display:none;}
    </style>
    <div class="noscriptmsg">
      Poll works best with JavaScript enabled    
    </div>
</noscript>
</head>



<body>
  <div class="container-fluid">
	 <header >
    <div class="row">
      <div class="col-lg-6 col-sm-12 text-center text-md-left "> <img src="{{ asset('images/vrsi_logo.png') }}" alt="Logo" height="100" class="img-fluid"> </div>
      <div class="col-lg-6 col-sm-12 caption text-md-right text-center justify-content-center align-self-center">
        <h2 class="text-success text-right">POLL ON RETINAL IMAGES</h2>
      </div>
    </div>
  </div>
</header>
<hr class="mt-0" />
@if(Auth::check())
  <div class="row">
    <div class="col-lg-12 col-sm-12 text-right">
      <h5 class="pr-3">{{ Auth::user()->prefix }} {{ Auth::user()->last_name }} {{ Auth::user()->first_name }} <a href="{{ url('logout') }}">Logout</a></h5>
    </div>
  </div>
  @endif
</div>  
<div class="container content">
  <br/>
  <div class="row align-items-center">
    
    
      @if(Session::has('msgSuccess'))

                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="alert alert-success" role="alert">
                     <a href="#" class="close" data-dismiss="alert">&times;</a>
                        <img src="{{asset('/images/success-icon.png')}}" > {{Session::get('msgSuccess') }}
                    </div>
                </div>

        @endif
        @if(Session::has('msgError'))
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="alert alert-danger" role="alert">
                 <a href="#" class="close" data-dismiss="alert">&times;</a>
                    {{Session::get('msgError') }}
                </div>
            </div>

    @endif
    <div class="col-lg-12 col-md-12 col-sm-12">
      @yield('content')
    </div>
    
  </div>
</div>

</div>
</body>
</html>