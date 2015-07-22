<!DOCTYPE html>
<html>
  <head>
    <title>@yield('title', 'Aprendiendo Laravel')</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{ HTML::style('css/style.css')}}
    <!-- Bootstrap -->
    {{ HTML::style('css/bootstrap.min.css', array('media' => 'screen')) }}
      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    {{ HTML::script('js/jquery.min.js') }}
        <!-- Include all compiled plugins (below), or include individual files as needed -->
    {{ HTML::script('js/bootstrap.min.js') }}
    {{ HTML::script('js/bootbox.min.js') }}

    
  </head>
  <body>
    <div id="wrap">
      <div class="container">
      	<div class="alert alert-danger hidden">
		      
		      <strong>Se han encontrado los siguentes errores:</strong>
		      <ul>
		     
		        <li id="msg_error"></li>
		      
		      </ul>
		    </div>
		    <div class="alert alert-success hidden">
		      
		      <strong>Confirmado:</strong>
		      <ul>
		     
		        <li id="msg_ok"></li>
		      
		      </ul>
		    </div>
      @if ($errors->any())
		    <div class="alert alert-danger">
		      <button type="button" class="close" data-dismiss="alert">&times;</button>
		      <strong>Se han encontrado los siguentes errores:</strong>
		      <ul>
		      @foreach ($errors->all() as $error)
		        <li>{{ $error }}</li>
		      @endforeach
		      </ul>
		    </div>
	 	@endif
	 	
	 	@if (Session::has('errores'))
		    <div class="alert alert-danger">
		      <button type="button" class="close" data-dismiss="alert">&times;</button>
		      <strong>Se han encontrado los siguentes errores:</strong>
		      <ul>
		      @foreach (Session::get('errores') as $error)
		        <li>{{ $error }}</li>
		      @endforeach
		      </ul>
		    </div>
	 	@endif
        @yield('content')
      </div>
    </div>
    </body>
</html>