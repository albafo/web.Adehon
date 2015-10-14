<?php

//Controlador de la sección EMPRESAS

class Empresa_EmpresaController extends \BaseController {
	public $errors;
	
	//Página inicial
	
	
	
	
	
    public function getIndex()
    {
    	if(!$this->checkLoggedEmpresa()) {
    		return $this->redirect;
    	}
    	$id_empresa=Session::get('id_empresa');
		$empresa=new Empresa;
		$usuario=new Usuario;
		$ofertas=$empresa->find($id_empresa)->ofertas()->get();
		$i=0;
		$ofertaA=array();
		$aux=array();
		foreach($ofertas as $oferta) {
			$ofertaA[$i]['candidatos']=$usuario->candidatosOferta($oferta);
			$ofertaA[$i]['oferta']=$oferta;
			$i++;
		}
		
		foreach($ofertaA as $key=>$oferta) {
			foreach($oferta['candidatos'] as $key1=>$candidato) {
			
				$aux[$key1]=$candidato['compatibilidad'];
			}
			array_multisort($aux, SORT_DESC, $ofertaA[$key]['candidatos']);
		}	
				
    	return View::make('empresa/panelhome', array('ofertas'=>$ofertaA, 'thisA'=>$this));
    	
    }
    
    //Controla el envío del formulario de login
    public function postLogin(){
    	include app_path()."/include/cifrado.php";
    	$errores=new Errores;
    	$empresas=new Empresa;
    	$data=Input::all();
    	$empresa=$empresas->getEmpresabyEmail($data['email']);
    	
    	if(!$empresa) {
			$errores->addError('Usuario o contraseña incorrectos');
    		return Redirect::action('Empresa_EmpresaController@getLogin')->with('errores', $errores->all());
    		
    	}
    	$pass=$empresa->password;
    	 
    	if(descifrar($data['password'], $pass)) {
    		Session::flush();
    		Session::put('ip_address', $_SERVER['REMOTE_ADDR']);
    		Session::put('logged_empresa', true);
    		Session::put('id_empresa', $empresa->id);
    		
    		$empresa->accesos_erroneos=0;
    		$empresa->save();
    		//return Redirect::action('Empresa_EmpresaController@getIndex');
    		return Redirect::intended('empresa/index');
    		
    		
    	}
    	else {
    		$accesos=$empresa->accesos_erroneos;
    		$empresa->accesos_erroneos++;
    		$empresa->save();
    		Session::flush();
			$errores->addError('Usuario o contraseña incorrectos');
			return Redirect::action('Empresa_EmpresaController@getLogin')->with('errores', $errores->all());
				
    	}
    	
    }
    
    //Abre la vista de login
    public function getLogin() {
    	$msg_ok=Session::pull('msg_ok');
    	$msg_wr=Session::pull('msg_wr');
    	$array_param=array();
    	if($msg_ok!=NULL) {
    		$array_param=array('msg_ok'=>$msg_ok);
    	}
    	if($msg_wr!=NULL) {
    		$array_param=array('msg_wr'=>$msg_wr);
    	}
    	return View::make('empresa/login')->with($array_param);
    }
    
    //Abre la vista que verifica el código mail
    public function getVerificar($id=NULL) {
    	if($id==NULL) {
    		return Redirect::action('ErrorController@getWrongUrl');
    	}
    	return View::make('verificar', array('action'=>array('Empresa_EmpresaController@postVerificar', $id), 'message_ok' => Session::pull('message_ok')));
    		
    }
    
    //Controla envío del form de verificación código mail
    public function postVerificar($id=NULL) {
    	if($id==NULL) {
    		return Redirect::action('ErrorController@getWrongUrl');
    	}
    	
    	$empresas=new Empresa;
    	$empresa=$empresas->getEmpresa($id);
    	$cod_verif=$empresa->cod_verif;
    	$cod_verif_user=Input::get('cod_verif');
    	
    	if($cod_verif!=$cod_verif_user) {
    		$errores=new Errores;
			$errores->addError('Código de verificación incorrecto');
			return Redirect::action('Empresa_EmpresaController@getVerificar', array('id'=>$id))->with('errores', $errores->all());
    	}	
		
		$empresa->verificado=1;
		$empresa->save();
		return Redirect::action('Empresa_EmpresaController@getLogin')->with('msg_ok','Cuenta activada.
    				Puedes entrar a tu cuenta insertando tu e-mail y tu contraseña.');
    	
    	 
	}
    
	// Controla envío form Regisro
    public function postRegistro() {
    	include_once public_path() . '/securimage/securimage.php';
    	$securimage = new Securimage();
    	$captcha_sesion=strtoupper($securimage->getCode());
    	include app_path()."/include/cifrado.php";
    	$empresa=new Empresa;
    	$data=Input::all();
    	$data['captcha_sesion']=$captcha_sesion;
    	$data['captcha_code']=strtoupper($data['captcha_code']);
    	
    	if(!$empresa->isValid($data)) {
    		return Redirect::action('Empresa_EmpresaController@getRegistro')->withInput(Input::except('password'))->withErrors($empresa->errors)->with('id_municipio', $data['municipio']);
    	}
    	foreach($data as $key=>$value) {
    		if($key!='password' && $key!='email')
    			$data[$key]=strtoupper($value);
    	}
    	$data['password']=encriptar($data['password']);
    	$data['cod_verif']=rand(111111, 999999);
    	$empresa->fill($data);
    	$empresa->save();
    	return Redirect::action('Empresa_EmpresaController@getVerificar', array($empresa->id))->with('message_ok', 'Registro Completado. 
    			Por favor, inserte el código de verificación que le hemos enviado a su correo electrónico. Gracias');
    	
    }
    
    
    public function getRegistro()
    {
    	// Extraemos las provincias y municipios de los xml
    	$provincia_array=$this->provincias();
	
    	 
    	 //return $provincia_array[0]['nombre'];
    	 return View::make('empresa/registro', array('provincias' => $provincia_array ));
    }
    
    public function getMunicipios($provincia) {
    	$sxe = new SimpleXMLElement(public_path().'/xml/municipios.xml', NULL, true);
    	$i=0;
	    foreach($sxe->municipios[0]->row as $municipio) {
	    	
    	 	if($municipio->CPRO==$provincia) {
    	 		$cod_municipio=$municipio[0]->id;
    	 		$cod_municipio=(string)$cod_municipio;
    	 		$municipio_array[$cod_municipio]=$municipio[0]->NOMBRE;
    	 		$i++;
    	 	}
	   	}
	   	
	   	return Response::json($municipio_array);
	   	
    }
    
	
    
    public function getNuevaOferta(){
    	if(!$this->checkLoggedEmpresa()) {
    		return $this->redirect;
    	}
    	
    	for($i=1;$i<=12;$i++) {
    		$meses[$i]=$i." ".Lang::choice('forms.mes', $i);
    	}
    	$meses[]="<1 ". Lang::choice('forms.mes', 1);
    	
    	$salarios[]="< ".number_format(Config::get('app.minSalario'), 0, '', '.')."€";
    	for($i=Config::get('app.minSalario'); $i<=Config::get('app.maxSalario')-5000; $i+=5000){
    		$salarios[]=trans('forms.salarios', array('menor'=>number_format($i, 0, '', '.').'€',  'mayor'=>number_format($i+5000, 0, '', '.').'€'));
    	}
    	$salarios[]='> '.number_format(Config::get('app.maxSalario'), 0, '', '.').'€';
    	
    	$provincia_array=$this->provincias();
    	 $empresas=new Empresa;
    	
 		$selected_pro=$empresas->where('id', '=', Session::get('id_empresa'))->firstOrFail();
 		$selected_pro=$selected_pro->provincia;
 		
    $sxe = new SimpleXMLElement(public_path().'/xml/municipios.xml', NULL, true);
    	$i=0;
	    foreach($sxe->municipios[0]->row as $municipio) {
	    	
    	 	if($municipio->CPRO==$selected_pro) {
    	 		$cod_municipio=$municipio[0]->id;
    	 		$cod_municipio=(string)$cod_municipio;
    	 		$municipio_array[$cod_municipio]=$municipio[0]->NOMBRE;
    	 		$i++;
    	 	}
	   	}
 		
 		
 		
 		$selected_mun=$empresas->where('id', '=', Session::get('id_empresa'))->firstOrFail()->municipio;
 		$id=Session::get('id_empresa');
 		$calle=$empresas->getEmpresa($id)->direccion;
 		$cp=$empresas->getEmpresa($id)->cod_postal;
		
		$anyos[]=trans('forms.sinExperiencia');
		$anyos[]='< 1 '.Lang::choice('forms.anyo', 1);
		for($i=1; $i<=Config::get('app.maxAnyosExpLaboral'); $i++){
			$anyos[]=$i." ".Lang::choice('forms.anyo', $i);
		}
		$anyos[]='> '.($i-1)." ".Lang::choice('forms.anyo', $i);
		
		
		$formacionTitulaciones[0]='Seleccione nivel formativo...';
		foreach(trans('forms.nivelesFormativos') as $key=>$value) {
			if($key>2)
				$formacionTitulaciones[$key]=$value;
		}
		
		
    	return View::make('empresa/nuevaOferta', array('mesesContrato'=>$meses, 'salarios'=>$salarios, 'provincias'=>$provincia_array, 'municipios'=>$municipio_array, 
    			'selected_mun'=>$selected_mun, 'selected_pro'=>$selected_pro, 'calle'=>$calle, 'cp'=>$cp, 'anyosExp'=>$anyos, 'areasEmpleo'=>$this->listaAreas()
				, 'formacionTitulos'=>$formacionTitulaciones));
    }


    
    public function getMisOfertas() {
    	if(!$this->checkLoggedEmpresa()) {
    		return $this->redirect;
    	}
    	$ofertaC=new Oferta;
    	$ofertas=$ofertaC->obtenerOfertas(Session::get('id_empresa'));
    	
    	
		
    	return View::make('empresa/misOfertas', array('ofertas'=>$ofertas, 'thisA'=>$this));
    	
    }
    
	public function getOferta($id) {
		if(!$this->checkLoggedEmpresa()) {
    		return $this->redirect;
    	}
		$oferta=new Oferta;
		$oferta=$oferta->where('id', '=', $id)->where('empresa_id', '=', Session::get('id_empresa'))->firstOrFail();
		
		return View::make('empresa/oferta', array('oferta'=>$oferta, 'thisA'=>$this));
 
	}
    
	public function getFuncionesAreas($id_area) {
		if($funciones=$this->funcionesArea($id_area)) {
			return $funciones;
		}
		else return "";
	}
	
	public function getListadoEmpresaS2() {
		$empresa=new Empresa;
		$columnas[0]['data']="razon_social";
		$empresas=$empresa->searchDT($columnas, $_GET['q'])->orderBy('razon_social', 'asc')->get();
		$i=0;
		$data=array();
		foreach($empresas as $empresa) {
			$data[$i]['id']=$empresa->id;
			$data[$i]['nombre']=$empresa->razon_social;
			$i++;
		}
		return $data;
	}
	
   	public function getListadoEmpresasDT() {
   		$empresa=new Empresa;
		
		if($_GET['columns'][$_GET['order'][0]['column']]['data']=="municipio" || $_GET['columns'][$_GET['order'][0]['column']]['data']=="provincia") {
			$_GET['columns'][$_GET['order'][0]['column']]['data'].="_id";
		}
		if($_GET['search']['value']!='') {
			
			$empresas=$empresa->searchDT($_GET['columns'], $_GET['search']['value'])->orderBy($_GET['columns'][$_GET['order'][0]['column']]['data'], $_GET['order'][0]['dir'])->skip($_GET['start'])->take($_GET['length'])->get();
			$count=$empresa->searchDT($_GET['columns'], $_GET['search']['value'])->orderBy($_GET['columns'][$_GET['order'][0]['column']]['data'], $_GET['order'][0]['dir'])->skip($_GET['start'])->take($_GET['length'])->count();
		}
		else{
			$empresas=$empresa->orderBy($_GET['columns'][$_GET['order'][0]['column']]['data'], $_GET['order'][0]['dir'])->skip($_GET['start'])->take($_GET['length'])->get();
			$count=$empresa->count();
		}
		
		foreach($empresas as $empresaN) {
			$provincia=$empresaN->provincia()->get();
			$municipio=$empresaN->municipio()->get();
			if(isset($provincia[0])) 
				$empresaN['provincia']=$provincia[0]['NOMBRE'];
			else $empresaN['provincia']="-";
			if(isset($municipio[0]))
				$empresaN['municipio']=$municipio[0]['NOMBRE'];
			else $empresaN['municipio']="-";
			$empresaN['DT_RowId']="row_".$empresaN['id'];
			$empresasNew[]=$empresaN;
		}
		if(isset($empresasNew)) {
			
			 
			$return['data']=$empresasNew;
			$return['recordsTotal']=$empresa->count();
			$return['recordsFiltered']=$count;
		}
		else {
			$return['data']='';
			$return['recordsTotal']=0;
			$return['recordsFiltered']=0;
		}
  		$return['draw']=$_GET['draw'];
		return $return;
   }

	
	public function getFichaEmpresa($id_empresa){
		
		$empresa=new Empresa;
		$data=$empresa->findById($id_empresa)->get();
		$provincias=new Provincia;
		$municipios=new Municipio;
		
		return View::make('empresa/ficha', array('data'=>$data[0], 'provincias'=>$provincias->arraySelect(), 'municipios'=>$municipios->municipiosProvincia($data[0]->provincia_id)));
		
	}
	
	public function postFichaEmpresa($id_empresa) {
		$empresa = Empresa::find($id_empresa);
        $data = $_POST;
        foreach ($data as $index => &$value) {
            if($index == "field_eval_fecha_evaluacion")
                $value = DateSql::changeToSql($value);
        }

        $this->saveCRUDForm($empresa, $data);
        return Redirect::back()->withOk('Ficha modificada con éxito');
	}
	
	public function getEliminarEmpresa($id_empresa) {
		$empresa=new Empresa;
		$empresa=$empresa->findById($id_empresa)->delete();
		return Redirect::to('gestor/empresas')->withName('Borrado con éxito');
			
	}
	

}
