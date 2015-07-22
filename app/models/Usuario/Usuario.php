<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Usuario
 *
 * @property integer $id 
 * @property string $nombre 
 * @property string $apellidos 
 * @property string $dni 
 * @property integer $sexo 
 * @property string $fecha_nacimiento 
 * @property string $calle 
 * @property string $cp 
 * @property integer $provincia_id 
 * @property integer $municipio_id 
 * @property string $email 
 * @property integer $cod_verif 
 * @property \Carbon\Carbon $updated_at 
 * @property \Carbon\Carbon $created_at 
 * @property integer $verificado 
 * @property integer $accesos_erroneos 
 * @property string $password 
 * @property integer $area_empleo 
 * @property string $deleted_at 
 * @property integer $nivel_acceso 
 * @property string $telefono1 
 * @property string $telefono2 
 * @property string $observaciones 
 * @property-read \Illuminate\Database\Eloquent\Collection|\TrabajoUsuario[] $trabajos 
 * @property-read \Illuminate\Database\Eloquent\Collection|\Estudio[] $estudios 
 * @property-read \Illuminate\Database\Eloquent\Collection|\FuncionUsuario[] $funciones 
 * @property-read \Illuminate\Database\Eloquent\Collection|\Oferta[] $ofertas 
 * @property-read \Illuminate\Database\Eloquent\Collection|\Titulacion[] $titulaciones 
 * @property-read \Municipio $municipios 
 * @property-read \Provincia $provincias 
 * @method static \Illuminate\Database\Query\Builder|\Usuario whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Usuario whereNombre($value)
 * @method static \Illuminate\Database\Query\Builder|\Usuario whereApellidos($value)
 * @method static \Illuminate\Database\Query\Builder|\Usuario whereDni($value)
 * @method static \Illuminate\Database\Query\Builder|\Usuario whereSexo($value)
 * @method static \Illuminate\Database\Query\Builder|\Usuario whereFechaNacimiento($value)
 * @method static \Illuminate\Database\Query\Builder|\Usuario whereCalle($value)
 * @method static \Illuminate\Database\Query\Builder|\Usuario whereCp($value)
 * @method static \Illuminate\Database\Query\Builder|\Usuario whereProvinciaId($value)
 * @method static \Illuminate\Database\Query\Builder|\Usuario whereMunicipioId($value)
 * @method static \Illuminate\Database\Query\Builder|\Usuario whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\Usuario whereCodVerif($value)
 * @method static \Illuminate\Database\Query\Builder|\Usuario whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Usuario whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Usuario whereVerificado($value)
 * @method static \Illuminate\Database\Query\Builder|\Usuario whereAccesosErroneos($value)
 * @method static \Illuminate\Database\Query\Builder|\Usuario wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\Usuario whereAreaEmpleo($value)
 * @method static \Illuminate\Database\Query\Builder|\Usuario whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Usuario whereNivelAcceso($value)
 * @method static \Illuminate\Database\Query\Builder|\Usuario whereTelefono1($value)
 * @method static \Illuminate\Database\Query\Builder|\Usuario whereTelefono2($value)
 * @method static \Illuminate\Database\Query\Builder|\Usuario whereObservaciones($value)
 */
class Usuario extends Eloquent {
	use SoftDeletingTrait;
	
	protected $fillable = array('*');
	protected $guarded = array('id', 'password');
	protected $hidden = array('password');
	
	public function getUserbyEmail($email) {
		if($this->where('email', '=', $email)->count()<1) {
			return false;
		}
		else return $this->where('email', '=', $email)->firstOrFail();
	}
	
	
		
	public function isValid($data)
	{
		
		
		$rules = array(
			'email'     => 'unique:usuarios',
			'captcha_sesion' => 'same:captcha_code',
			'fecha_nacimiento'=>'checkdate'
		);
		$messages =  array(
				
				'email.unique'          => 'Existe un usuario con ese Email',
				
				'captcha_sesion.same'    => 'Código anti-spam incorrecto',
				
				'fecha_nacimiento.checkdate'=>'Fecha de nacimiento incorrecta'
		);
		
		$validator = Validator::make($data, $rules, $messages);
	
		if ($validator->passes())
		{
			return true;
		}
	
		$this->errors = $validator->errors();
	
		return false;
	}
	public function trabajos() {
			return $this->hasMany('TrabajoUsuario');
	}
	
	public function estudios() {
			return $this->belongsToMany('Estudio');
	}
	
	public function funciones() {
			return $this->hasMany('FuncionUsuario');
	}
	
	public function ofertas() {
		 return $this->belongsToMany('Oferta');
	}
	
	public function titulaciones() {
		return $this->belongsToMany('Titulacion');
	}
	
	public function municipios() {
		return $this->belongsTo('Municipio', 'municipio_id');
	}
	
	public function provincias() {
		return $this->belongsTo('Provincia', 'provincia_id');
	}

	public function funcionesTrabajos()
    {
        return $this->hasManyThrough('FuncionTrabajoUsuario', 'TrabajoUsuario' );
		
    }
	
	public function compatibilidad($oferta) {
		/* Compatibilidad usuario-oferta */
		
		/* - Funciones 30%
		 * - Area principal 20%
		 * - Experiencia área 10%
		 * - Misma provincia 3%
		 * - Misma ciudad 7%
		 * - Titulación 10%
		 * - Edad 10%
		 * - Nivel Formativo mínimo 10%
		 */
		 
		
		 
		 $porcFinal=0;
		 
		 /* Calculamos y añadimos porcentaje según cumpla funciones */
		$funciones=$oferta->funciones()->get();
		$funcionesUsuario=$this->funciones()->get();
		$funcionesUsuarioTrabajos=$this->funcionesTrabajos()->get();
		$numFuncionesUsuario=0;
		$numFunciones=$oferta->funciones()->count();
		$funcionesU=array();
		foreach($funcionesUsuario as $funcion) {
			$funcionesU[]=$funcion->funcion;
		}
		foreach($funcionesUsuarioTrabajos as $funcion) {
			$funcionesU[]=$funcion->funcion;
		}
		$funcionesU = array_unique($funcionesU);
		foreach($funciones as $funcion) {				
			foreach($funcionesU as $funcionUsuario) {
				if($funcion->funcion==$funcionUsuario) {
					
					$numFuncionesUsuario++;
				}
			}
		}
		if($numFunciones > 0) {
			$porcFunciones=($numFuncionesUsuario/$numFunciones)*100; 
		}
		else $porcFunciones=100;
		$porcFinal+=$porcFunciones*0.3;
		
		 /*  Añadimos porcentaje según cumpla área principal */
		 
		 if($oferta->area_empleo==$this->area_empleo) {
		 	$porcFinal+=20;
		 }
		 
		 /* Añadimos porcentaje según cumpla con experiencia mínima en el área */
		 
		 $trabajosCand=$this->trabajos()->where('area_empleo', '=', $oferta->area_empleo)->get();
		 $anyosExp=0;
		 foreach($trabajosCand as $trabajoCand) {
		 	$anyosExp+=$trabajoCand->anyo_final-$trabajoCand->anyo_inicio;
		 }
		 if($oferta->experiencia<1) {
		 	$porcFinal+=10;
		 }
		 if($oferta->experiencia>0 && $oferta->experiencia < 12) {
			 if($anyosExp>=$oferta->experiencia-1) {
			 	$porcFinal+=10;
			 }
		 }
		 
		 if($oferta->experiencia>11) {
		 	if($anyosExp>10) {
			 	$porcFinal+=10;
			 }
		 }
		
		  /* Añadimos porcentaje si está en la misma provincia */
		  
		  if($oferta->provincia==$this->provincia) {
		  	$porcFinal+=3;
		  }
		 
		   /* Añadimos porcentaje si está en la misma ciudad */
		   
		  if($oferta->municipio==$this->municipio) {
		  	$porcFinal+=7;
		  }
		 
		  /* Añadimos porcentaje si tiene alguna titulación de la oferta*/
		  
		  $flagTit=false;
		  $titulacionesUser=$this->estudios()->get();
		  $titulacionesOferta=$oferta->titulaciones()->get();
		 
		  foreach($titulacionesUser as $titulacionUser) {
		  	foreach($titulacionesOferta as $titulacionOferta) {
		  		if($titulacionOferta->titulacion==$titulacionUser->titulo) {
		  			$flagTit=true;
		  		}
		  	}
		  }
		  if($flagTit) {
		  	$porcFinal+=10;
		  }
		     
		  		  /* Añadimos porcentaje si está en el rango de edad*/
		  
		  
		  $edadUser=$this->obtenerEdad($this->fecha_nacimiento);
		  if($edadUser >= $oferta->perfil_edad_min && $edadUser<=$oferta->perfil_edad_max) {
		  	$porcFinal+=10;
		  }
		   
		  /*Añadimos porcentaje si cumple mínimo estudios*/
			
			if($this->estudios()->get()->max('formacion')>=$oferta->nivel_formativo_min) {
				$porcFinal+=10;
			}
		
		 
		  
		  return $porcFinal;
		 
	}

	public function obtenerEdad() {
		$timeN=strtotime($this->fecha_nacimiento);
		$timeA=strtotime("now");
		//echo "$timeN $timeA ";
		$edad=floor(($timeA-$timeN)/31536000);
		return $edad>0 ? $edad : false;
	}
	
	public function candidatosOferta($oferta) {
		$usuarios=$this->rightJoin('trabajos_usuarios', 'usuarios.id', '=', 'trabajos_usuarios.usuario_id')->
					where('trabajos_usuarios.area_empleo', '=', $oferta->area_empleo)->orWhere('usuarios.area_empleo', '=', $oferta->area_empleo)
					->groupBy('usuarios.id');
					$candidatosInfo=$usuarios->get(array('usuarios.*'));
		$i=0;
		if($usuarios->count()>0) {
			$candidatosInfo=$usuarios->get();
			
			foreach($candidatosInfo as $candidatoInfo) {
				$candidatos[$i]['info']=$candidatoInfo;
				$candidatos[$i]['compatibilidad']=$candidatoInfo->compatibilidad($oferta);
				if($candidatoInfo->ofertas()->where('oferta_id', '=', $oferta->id)->count()>0)
					$candidatos[$i]['inscrito']=1;
				else 
					$candidatos[$i]['inscrito']=0;
				$i++;
			}
		}
		
		
		return isset($candidatos) ? $candidatos : false;
	}
	
	public static function especializacion($tablaJoin, $attrWhere, $attrValue, $selectArray) {
		$usuario=Usuario::leftJoin($tablaJoin, $tablaJoin.'.usuario_id', '=', 'usuarios.id')
		->where($attrWhere, '=', $attrValue)->select($selectArray)->get()
		->first();
		return $usuario;
		
	}

	/*public function candidatosOferta($oferta) {
		
		
			$trabajoUsuario=new TrabajoUsuario;
			
			$usuarios=$this->where('area_empleo', '=', $oferta->area_empleo);
			if($usuarios->count()>0) {
				
				$candidatosInfo=$usuarios->get();
				$j=0;
				foreach($candidatosInfo as $candidatoInfo) {
					
					$candidatos[$j]['info']=$candidatoInfo;
					$numFunciones=$oferta->funciones()->count();
					if($numFunciones>0) {
						$funciones=$oferta->funciones()->get();
						$numFuncionesUsuario=0;
						$funcionesUsuario=$candidatoInfo->funciones()->get();
						foreach($funciones as $funcion) {
							
							foreach($funcionesUsuario as $funcionUsuario) {
								if($funcion->funcion==$funcionUsuario->funcion) {
									
									$numFuncionesUsuario++;
								}
							}
						}
						$porcFunciones=($numFuncionesUsuario/$numFunciones)*100;
						$candidatos[$j]['compatibilidad']=10+($porcFunciones*0.9);
					}
					else {
						$candidatos[$j]['compatibilidad']=100;
					}
					
					$j++;
				}	
				
				
				
			}
			else {
					$usuarios=$this->leftJoin('trabajos_usuarios', 'usuarios.id', '=', 'trabajos_usuarios.usuario_id')->
					where('trabajos_usuarios.area_empleo', '=', $oferta->area_empleo)->groupBy('usuarios.id');
					
					$candidatosInfo=$usuarios->get(array('usuarios.*'));
					
				if($usuarios->count()>0) {
					$j=0;
					foreach($candidatosInfo as $candidatoInfo) {
						
						$candidatoInfo->funciones()->get();
						
						$candidatos[$j]['info']=$candidatoInfo;
						$numFunciones=$oferta->funciones()->count();
						if($numFunciones>0) {
							$funciones=$oferta->funciones()->get();
							$numFuncionesUsuario=0;
							$funcionesUsuario=$candidatoInfo->funcionesTrabajos()->groupBy('funcion')->get();
							
							foreach($funciones as $funcion) {
								foreach($funcionesUsuario as $funcionUsuario) {
									if($funcion->funcion==$funcionUsuario->funcion) {
										$numFuncionesUsuario++;
									}
								}
							}
							$porcFunciones=($numFuncionesUsuario/$numFunciones)*100;
							$candidatos[$j]['compatibilidad']=($porcFunciones*0.9);
						}
						else {
							$candidatos[$j]['compatibilidad']=90;
						}
						
						$j++;
					}	
					
				
					
					
					
				}
				
			}
		
		
		return isset($candidatos) ? $candidatos : false;
	}*/
}