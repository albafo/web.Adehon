<?php

//Controlador de la sección USUARIOS

class Usuario_UsuarioController extends \BaseController {
	
	 public function getIndex()
    {
    	if(!$this->checkLoggedUsuario()) {
    		
    		return $this->redirect;
    	}
    	$id=Session::get('id_usuario');
		$usuario=new Usuario;
		$usuario=$usuario->find($id);
		$oferta=new Oferta;
		
		if(!$ofertas=$oferta->ofertasUsuario($usuario)) 
			return View::make('usuario/panelhome');
			
		foreach($ofertas as $oferta_a) {
			
			foreach($oferta_a as $oferta_s){
				$ofertas_array[]=$oferta_s;
			if($oferta_s->salario<1) {
				$salarios[]="< 10.000€";
			}
			else if($oferta_s->salario>11) {
				$salarios[]="> 65.000€";
			}
			else {
				$salario_min=($oferta_s->salario-1)*5000+10000;
				$salario_max=($oferta_s->salario-1)*5000+15000;
				$salarios[]=trans('forms.salarios', array('menor'=>number_format($salario_min, 0, '', '.').'€',  'mayor'=>number_format($salario_max, 0, '', '.').'€'));
			}
			$municipios[]=$this->nombreMunicipio($oferta_s->municipio);
		}
		}
		
		
    	return View::make('usuario/panelhome', array('ofertas'=>$ofertas_array, 'salarios'=>$salarios, 'municipios'=>$municipios));
    	
    }
	
	
	
	 public function getRegistro()
    {
    	
    	// Extraemos las provincias y municipios de los xml
    	$provincia_array=$this->provincias();
    	
    	 //return $provincia_array[0]['nombre'];
    	 return View::make('usuario/registro', array('provincias' => $provincia_array ));
    }
	
	public function postRegistro() {
    	include_once public_path() . '/securimage/securimage.php';
    	$securimage = new Securimage();
    	$captcha_sesion=strtoupper($securimage->getCode());
    	include app_path()."/include/cifrado.php";
    	$usuario=new Usuario;
    	$data=Input::all();
    	$data['captcha_sesion']=$captcha_sesion;
    	$data['captcha_code']=strtoupper($data['captcha_code']);
    	$data['fecha_nacimiento']=$data['anyo']."-".$data['mes']."-".$data['dia'];
    	
    	foreach($data as $key=>$value) {
    		if($key!='password' && $key!='email')
    			$data[$key]=mb_strtoupper($value, 'UTF-8');
    	}
    	$data['password']=encriptar($data['password']);
    	$data['cod_verif']=rand(111111, 999999);
		if(!$usuario->isValid($data)) {
    		return Redirect::action('Usuario_UsuarioController@getRegistro')->withInput(Input::except('password'))->withErrors($usuario->errors)->with('id_municipio', $data['municipio']);
    	}
    	$usuario->fill($data);
    	$usuario->save();
    	return Redirect::action('Usuario_UsuarioController@getVerificar', array($usuario->id))->with('message_ok', 'Registro Completado. 
    			Por favor, inserte el código de verificación que le hemos enviado a su correo electrónico. Gracias');
    	
    }
	
	
	public function getVerificar($id=NULL) {
		if($id==NULL) {
    		return Redirect::action('ErrorController@getWrongUrl');
    	}
    	return View::make('verificar', array('action'=>array('Usuario_UsuarioController@postVerificar', $id),'message_ok' => Session::pull('message_ok')));
	}

	public function postVerificar($id=NULL) {
		if($id==NULL) {
    		return Redirect::action('ErrorController@getWrongUrl');
    	}
    	
    	$usuario=new Usuario;
    	$usuario=$usuario->find($id);
    	$cod_verif=$usuario->cod_verif;
    	$cod_verif_user=Input::get('cod_verif');
    	
    	if($cod_verif!=$cod_verif_user) {
    		$errores=new Errores;
			$errores->addError('Código de verificación incorrecto');
						return Redirect::action('Usuario_UsuarioController@getVerificar', array('id'=>$id))->with('errores', $errores->all());

    	}
		
		$usuario->verificado=1;
		$usuario->save();
		return Redirect::action('Usuario_UsuarioController@getLogin')->with('msg_ok','Cuenta activada.
    				Puedes entrar a tu cuenta insertando tu e-mail y tu contraseña.');	
	}
	
	public function getLogin() {
    	$msg_ok=Session::pull('msg_ok');
    	$msg_wr=Session::pull('msg_wr');
    	$array_param=array('action'=>array('Usuario_UsuarioController@postLogin'));
    	if($msg_ok!=NULL) {
    		$array_param['msg_ok']=$msg_ok;
    	}
    	if($msg_wr!=NULL) {
    		$array_param['msg_wr']=$msg_wr;
    	}
		$array_param['title']='Usuarios';
    	return View::make('login')->with($array_param);
    }
	
	public function postLogin(){
    	include app_path()."/include/cifrado.php";
    	$errores=new Errores;
    	$usuarios=new Usuario;
    	$data=Input::all();
    	$usuario=$usuarios->getUserbyEmail($data['email']);
    	
    	if(!$usuario) {
			$errores->addError('Usuario o contraseña incorrectos');
    		return Redirect::action('Usuario_UsuarioController@getLogin')->with('errores', $errores->all());
    		
    	}
    	$pass=$usuario->password;
    	 
    	if(descifrar($data['password'], $pass)) {
    		Session::flush();
    		Session::put('ip_address', $_SERVER['REMOTE_ADDR']);
    		Session::put('logged_usuario', true);
    		Session::put('id_usuario', $usuario->id);
    		
    		$usuario->accesos_erroneos=0;
    		$usuario->save();
    		//return Redirect::action('Empresa_EmpresaController@getIndex');
    		return Redirect::intended('usuario/index');
    		
    		
    	}
    	else {
    		$accesos=$usuario->accesos_erroneos;
    		$usuario->accesos_erroneos++;
    		$usuario->save();
    		Session::flush();
			$errores->addError('Usuario o contraseña incorrectos');
			return Redirect::action('Usuario_UsuarioController@getLogin')->with('errores', $errores->all());
				
    	}
    	
    }

	public function getEditarPerfilLaboral(){
		if(!$this->checkLoggedUsuario()) {
    		return $this->redirect;
    	}
    	
    	for($i=1;$i<=12;$i++) {
    		$meses[$i]=$i." ".Lang::choice('forms.mes', $i);
    	}
    	$meses[]="<1 ". Lang::choice('forms.mes', 1);
    	
    	$salarios[]="< 10.000€";
    	for($i=10000; $i<=60000; $i+=5000){
    		$salarios[]=trans('forms.salarios', array('menor'=>number_format($i, 0, '', '.').'€',  'mayor'=>number_format($i+5000, 0, '', '.').'€'));
    	}
    	$salarios[]='> 65.000€';
    	
    	 
 		
   
 		
 		
 		
 		
		
		$anyos[]=trans('forms.sinExperiencia');
		$anyos[]='< 1 '.Lang::choice('forms.anyo', 1);
		for($i=1; $i<=Config::get('app.maxAnyosExpLaboral'); $i++){
			$anyos[]=$i." ".Lang::choice('forms.anyo', $i);
		}
		$anyos[]='> '.($i-1)." ".Lang::choice('forms.anyo', $i);
		
		$areasEmpleo=trans('forms.areasEmpleo');
		$htmlTitulaciones='<ul class="newList hidden"  style="top: 23px; height: 212px; left: 0px;	">';
		
		foreach($areasEmpleo as $key=>$titulacion) {
			
			foreach($titulacion as $key=>$subTit) {
				$htmlTitulaciones.='<li id="element_2001" class="suboptions" key="2001">
        <span class="expand_element">[+]</span><a href="JavaScript:void(0);" class="">'.$key.'</a>
        <ul class="hidden">';
				foreach($subTit as $key=>$tit)
					$htmlTitulaciones.='<li key="'.$key.'"><a href="JavaScript:void(0);">'.$tit.'</a></li>';
			}
			$htmlTitulaciones.='</ul></li>';
		}
		$htmlTitulaciones.='</ul>';
		$usuario=new Usuario;
		$usuario=$usuario->find(Session::get('id_usuario'));
		$trabajos=$usuario->trabajos()->get();
		$titulaciones=$usuario->estudios()->get();
    	return View::make('usuario/editarPerfil', array('estudios'=>$titulaciones, 'trabajos'=>$trabajos, 'thisA'=>$this, 'usuario'=>$usuario, 'mesesContrato'=>$meses, 'salarios'=>$salarios, 'anyosExp'=>$anyos, 'areasEmpleo'=>$htmlTitulaciones));
    }
	
		public function postPerfilLaboral(){
			if(!$this->checkLoggedUsuario()) {
    			return $this->redirect;
    		}
			$id=Session::get('id_usuario');
			$usuario=new Usuario;
			$usuario=$usuario->find($id);
			$usuario->trabajos()->delete();
			$usuario->area_empleo=Input::get('area_empleo');
			$usuario->save();
			if (Input::has('area_empleo')) {
				
				$usuario->area_empleo=Input::get('area_empleo');
			}
			if (Input::has('experiencia'))
			{
				$usuario->trabajos()->delete();
				foreach(Input::get('experiencia') as $trabajo){
				
					$trabajos[]=new TrabajoUsuario($trabajo);
				}
				$usuario->trabajos()->saveMany($trabajos);
				
			}
			
			if (Input::has('titulacion')) {
				$usuario->estudios()->delete();
				foreach(Input::get('titulacion') as $titulacion){
				
					$titulaciones[]=new EstudioUsuario($titulacion);
				}
				$usuario->trabajos()->saveMany($titulaciones);
			}
			
			return Input::all();
		}
		
		
		public function getFuncionesAreas($id_area) {
		if($funciones=$this->funcionesArea($id_area)) {
			return $funciones;
		}
		else return "0";
	}
		
		
	public function getUsuariosCoordS2() {
		$usuario=new Usuario;
		
		$usuarios=$usuario->where(function($query){
			$search=$_GET['q'];
			$query->where('nombre', 'like', '%'.$search.'%')
			->orWhere('apellidos', 'like', '%'.$search.'%');
		})
		->where('nivel_acceso', '>', 0)->get();
		//$this->lastSQL();
		$i=0;
		$data=array();
		foreach($usuarios as $usuario) {
			$data[$i]['id']=$usuario->id;
			$data[$i]['nombre']=$usuario->nombre." ".$usuario->apellidos;
			$i++;
		}
		return $data;
	}
    
    
}