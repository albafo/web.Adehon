<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;


/**
 * Oferta
 *
 * @property integer $id 
 * @property integer $empresa_id 
 * @property string $fecha_alta 
 * @property integer $area_empleo 
 * @property integer $subarea_empleo 
 * @property string $puesto 
 * @property integer $plazas 
 * @property integer $experiencia 
 * @property integer $jornada_laboral 
 * @property integer $horario_laboral 
 * @property integer $contrato_id 
 * @property integer $meses_contrato 
 * @property string $fecha_caducidad 
 * @property integer $salario 
 * @property integer $perfil_edad_min 
 * @property integer $perfil_edad_max 
 * @property string $calle 
 * @property string $cp 
 * @property integer $estudio_id 
 * @property integer $provincia_id 
 * @property integer $municipio_id 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @property string $deleted_at 
 * @property boolean $activo 
 * @property-read \Illuminate\Database\Eloquent\Collection|\Titulacion[] $titulaciones 
 * @property-read \Illuminate\Database\Eloquent\Collection|\Usuario[] $candidatos 
 * @property-read \Municipio $municipio 
 * @property-read \Empresa $empresa 
 * @property-read \SubareaEmpleo $subarea 
 * @property-read \AreasEmpleo $area 
 * @property-read \Illuminate\Database\Eloquent\Collection|\Funcion[] $funciones 
 * @method static \Illuminate\Database\Query\Builder|\Oferta whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Oferta whereEmpresaId($value)
 * @method static \Illuminate\Database\Query\Builder|\Oferta whereFechaAlta($value)
 * @method static \Illuminate\Database\Query\Builder|\Oferta whereAreaEmpleo($value)
 * @method static \Illuminate\Database\Query\Builder|\Oferta whereSubareaEmpleo($value)
 * @method static \Illuminate\Database\Query\Builder|\Oferta wherePuesto($value)
 * @method static \Illuminate\Database\Query\Builder|\Oferta wherePlazas($value)
 * @method static \Illuminate\Database\Query\Builder|\Oferta whereExperiencia($value)
 * @method static \Illuminate\Database\Query\Builder|\Oferta whereJornadaLaboral($value)
 * @method static \Illuminate\Database\Query\Builder|\Oferta whereHorarioLaboral($value)
 * @method static \Illuminate\Database\Query\Builder|\Oferta whereContratoId($value)
 * @method static \Illuminate\Database\Query\Builder|\Oferta whereMesesContrato($value)
 * @method static \Illuminate\Database\Query\Builder|\Oferta whereFechaCaducidad($value)
 * @method static \Illuminate\Database\Query\Builder|\Oferta whereSalario($value)
 * @method static \Illuminate\Database\Query\Builder|\Oferta wherePerfilEdadMin($value)
 * @method static \Illuminate\Database\Query\Builder|\Oferta wherePerfilEdadMax($value)
 * @method static \Illuminate\Database\Query\Builder|\Oferta whereCalle($value)
 * @method static \Illuminate\Database\Query\Builder|\Oferta whereCp($value)
 * @method static \Illuminate\Database\Query\Builder|\Oferta whereEstudioId($value)
 * @method static \Illuminate\Database\Query\Builder|\Oferta whereProvinciaId($value)
 * @method static \Illuminate\Database\Query\Builder|\Oferta whereMunicipioId($value)
 * @method static \Illuminate\Database\Query\Builder|\Oferta whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Oferta whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Oferta whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Oferta whereActivo($value)
 */
class Oferta extends Eloquent {
		
	use SoftDeletingTrait;
	
	
	protected $guarded = array('id');
	  
	
	
	
	public function titulaciones() {
		return $this->belongsToMany('Titulacion', 'titulacion_oferta');
	}
	
	public function ofertasUsuario($usuario){
		$area_empleo=$usuario->area_empleo;
		
		$ofertas[]=$this->where('area_empleo', '=', $area_empleo)->get();
		$trabajos_user=$usuario->trabajos()->get();
		if(!$area_empleo)
			return false;
		foreach($trabajos_user as $trabajo) {
			$area_empleoSub=$trabajo->area_empleo;
			$ofertas[]=$this->where('area_empleo', '=', $area_empleoSub)->where('area_empleo', '<>', $area_empleo)->get();
		}
		return $ofertas;
	}
	
	
	
	public function obtenerOfertas($id_empresa=false, $id_usuario=false) {
		if($id_empresa){
			
			$ofertas=$this->where('empresa_id', '=', $id_empresa)->orderBy('created_at', 'desc')->get();
			
			//$links=$ofertas->links();
			//$links=(string)$links;
			//Session::flash('links', $links);
			$i=0;
		
			foreach($ofertas as $oferta) {
				$usuario=new Usuario;
				$candidatos=$usuario->candidatosOferta($oferta);
				
				$array[$i]['oferta']=$oferta;
				$array[$i]['candidatos']=$candidatos;
				$i++;
			}
		}
		if(isset($array)) {
			return $array;
		} 
		else {
			return false;
		}
		
	}

	public function numCandidatosPotenciales($candidatos) {
		$i=0;
		
		if(isset($candidatos) && $candidatos) {
			
			foreach($candidatos as $candidato) {
				
				if($candidato['compatibilidad']>49) {
					$i++;
				}
			}
		}
		return $i;
	}
	
	public function candidatos() {
		 return $this->belongsToMany('Usuario');
	}

	public function inscritos()
	{
		return $this->belongsToMany('Demandante')->withPivot("estado", "created_at");

	}
	
	public function municipio() {
		return $this->belongsTo('Municipio');
	}
	
	public function ofertasDT() {
		
	} 
	
	public function empresa() {
		return $this->belongsTo('Empresa');
	}
	
	public function subarea() {
		return $this->belongsTo('SubareaEmpleo', 'subarea_empleo');
	}
	
	public function area() {
		return $this->belongsTo('AreasEmpleo', 'area_empleo');
	}
	
	public function funciones() {
		return $this->belongsToMany('Funcion', 'funciones_ofertas', 'oferta_id', 'funcion_id');
	}
	
	
	
	
	public static function rangoSalario($id_salario) {
		$salarios[]="< ".number_format(Config::get('app.minSalario'), 0, '', '.')."€";
    	for($i=Config::get('app.minSalario'); $i<=Config::get('app.maxSalario')-5000; $i+=5000){
    		$salarios[]=trans('forms.salarios', array('menor'=>number_format($i, 0, '', '.').'€',  'mayor'=>number_format($i+5000, 0, '', '.').'€'));
    	}
    	$salarios[]='> '.number_format(Config::get('app.maxSalario'), 0, '', '.').'€';
		
		return $salarios[$id_salario];
	}
	
	public static function experienciaSelect() {
		$experiencia[0]=Lang::get("forms.sinExperiencia");
		for($i=1; $i<10; $i++) {
			$experiencia[$i]=$i." ".Lang::choice("forms.anyo", $i);
		}
		$experiencia[10]=">= 10 ".Lang::choice("forms.anyo", 10);
		return $experiencia;
	}
	
	public static function salariosSelect(){
		$salarios[]="< ".number_format(Config::get('app.minSalario'), 0, '', '.')."€";
    	for($i=Config::get('app.minSalario'); $i<=Config::get('app.maxSalario')-5000; $i+=5000){
    		$salarios[]=trans('forms.salarios', array('menor'=>number_format($i, 0, '', '.').'€',  'mayor'=>number_format($i+5000, 0, '', '.').'€'));
    	}
    	$salarios[]='> '.number_format(Config::get('app.maxSalario'), 0, '', '.').'€';
		return $salarios;
	}
	
	
	
	
	
	
}