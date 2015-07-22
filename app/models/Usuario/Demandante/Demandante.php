<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * Demandante
 *
 * @property integer $id 
 * @property integer $usuario_id 
 * @property \Carbon\Carbon $updated_at 
 * @property \Carbon\Carbon $created_at 
 * @property string $deleted_at 
 * @property integer $cp 
 * @property boolean $disponibilidad_viajar 
 * @property boolean $cambio_residencia 
 * @property integer $areaEmpleo_id 
 * @property integer $subareaEmpleo_id 
 * @property-read \Usuario $usuarios 
 * @method static \Illuminate\Database\Query\Builder|\Demandante whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Demandante whereUsuarioId($value)
 * @method static \Illuminate\Database\Query\Builder|\Demandante whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Demandante whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Demandante whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Demandante whereCp($value)
 * @method static \Illuminate\Database\Query\Builder|\Demandante whereDisponibilidadViajar($value)
 * @method static \Illuminate\Database\Query\Builder|\Demandante whereCambioResidencia($value)
 * @method static \Illuminate\Database\Query\Builder|\Demandante whereAreaEmpleoId($value)
 * @method static \Illuminate\Database\Query\Builder|\Demandante whereSubareaEmpleoId($value)
 */
class Demandante extends Eloquent {
	use SoftDeletingTrait;
	
	
	
	public function usuarios() {
		return $this->belongsTo('Usuario', 'usuario_id');
	}
	
	public function getOfertasComp() {
		return Oferta::where('area_empleo', '=', $this->areaEmpleo_id)->get();
	}
	
	public function getCompOferta($oferta) {
		// Base misma area de empleo = 25%
		$porcFinal=0;
		if($oferta->area_empleo==$this->areaEmpleo_id) {
			$porcFinal+=25;
		
			// Misma subarea += 15% 
		
			if($oferta->subarea_empleo==$this->subareaEmpleo_id) {
				$porcFinal+=15;
			}
			
			//Misma provincia += 5%
			
			if($oferta->provincia_id == $this->usuarios->provincia_id) {
				$porcFinal+=5;
			}
			
			//Mismo municipio += 5%
			
			if($oferta->municipio_id == $this->usuarios->municipio_id) {
				$porcFinal+=5;
			}
			
			//>=Experiencia en el área de empleo += 5%
			
			$anyosExperienciaSector=0;
			$trabajos=$this->usuarios->trabajos()->where('areaEmpleo_id', '=', $oferta->area_empleo)->get();
			foreach($trabajos as $trabajo) {
				$anyos=$trabajo->anyo_final-$trabajo->anyo_inicio;
				if($anyos==0) {
					$anyosExperienciaSector+=0.5;
				}
				else {
					$anyosExperienciaSector+=$anyos;
				}
			}
			
			$anyosExperienciaSector=floor($anyosExperienciaSector);
			if($oferta->experiencia<=$anyosExperienciaSector) {
				$porcFinal+=5;
			}
			
			//>=Experiencia en la subárea de empleo += 5%
			$anyosExperienciaSector=0;
			$trabajos=$this->usuarios->trabajos()->where('subareaEmpleo_id', '=', $oferta->subarea_empleo)->get();
			foreach($trabajos as $trabajo) {
				$anyos=$trabajo->anyo_final-$trabajo->anyo_inicio;
				if($anyos==0) {
					$anyosExperienciaSector+=0.5;
				}
				else {
					$anyosExperienciaSector+=$anyos;
				}
			}
			
			$anyosExperienciaSector=floor($anyosExperienciaSector);
			if($oferta->experiencia<=$anyosExperienciaSector) {
				$porcFinal+=5;
			}
			
			// % funciones 10%
			
			$numFunciones=$oferta->funciones->count();
			$contadorUser=0;
			foreach($oferta->funciones as $funcion) {
				$funcion_id=$this->usuarios->funciones()->where('funcion_id', '=', $funcion->id)->first();
				
				if(!is_null($funcion_id)) {
					$contadorUser++;
				}
			}
			
			if($numFunciones>0) {
				$porcFinal+=($contadorUser*10)/$numFunciones;
				
			}
			// estudios 10%
			if($this->usuarios->estudios->max('id')>=$oferta->estudio_id) {
				$porcFinal+=10;
			}
			
			//edad 5%
			
			if($this->usuarios->obtenerEdad()>=$oferta->perfil_edad_min && $this->usuarios->obtenerEdad()<=$oferta->perfil_edad_max) {
				$porcFinal+=5;
			}
			
			//titulacion 15%
			
			$titulaciones_usuario=$this->usuarios->titulaciones;
			$id_tit=array();
			foreach($titulaciones_usuario as $titulacion) {
				$id_tit[]=$titulacion->id;
			}
			$titulaciones_ofertas=$oferta->titulaciones()->whereIn('titulacions.id', $id_tit)->first();
			
			if(!is_null($titulaciones_ofertas)) {
				
				$porcFinal+=15;
			}
			
			
			
			
			
		}
		
		return $porcFinal;
		
	}
	
	
	
}