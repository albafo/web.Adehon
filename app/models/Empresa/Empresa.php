<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;

/**
 * Empresa
 *
 * @property integer $id 
 * @property string $cif 
 * @property string $razon_social 
 * @property string $direccion 
 * @property string $cp 
 * @property string $telefono 
 * @property string $fax 
 * @property string $representante 
 * @property integer $provincia_id 
 * @property integer $municipio_id 
 * @property integer $cod_postal 
 * @property string $email 
 * @property string $password 
 * @property \Carbon\Carbon $updated_at 
 * @property \Carbon\Carbon $created_at 
 * @property integer $cod_verif 
 * @property boolean $verificado 
 * @property integer $accesos_erroneos 
 * @property string $observaciones 
 * @property \Carbon\Carbon $deleted_at 
 * @property-read \Illuminate\Database\Eloquent\Collection|\Oferta[] $ofertas 
 * @property-read \Provincia $provincia 
 * @property-read \Municipio $municipio 
 * @method static \Illuminate\Database\Query\Builder|\Empresa whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\Empresa whereCif($value)
 * @method static \Illuminate\Database\Query\Builder|\Empresa whereRazonSocial($value)
 * @method static \Illuminate\Database\Query\Builder|\Empresa whereDireccion($value)
 * @method static \Illuminate\Database\Query\Builder|\Empresa whereCp($value)
 * @method static \Illuminate\Database\Query\Builder|\Empresa whereTelefono($value)
 * @method static \Illuminate\Database\Query\Builder|\Empresa whereFax($value)
 * @method static \Illuminate\Database\Query\Builder|\Empresa whereRepresentante($value)
 * @method static \Illuminate\Database\Query\Builder|\Empresa whereProvinciaId($value)
 * @method static \Illuminate\Database\Query\Builder|\Empresa whereMunicipioId($value)
 * @method static \Illuminate\Database\Query\Builder|\Empresa whereCodPostal($value)
 * @method static \Illuminate\Database\Query\Builder|\Empresa whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\Empresa wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\Empresa whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Empresa whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\Empresa whereCodVerif($value)
 * @method static \Illuminate\Database\Query\Builder|\Empresa whereVerificado($value)
 * @method static \Illuminate\Database\Query\Builder|\Empresa whereAccesosErroneos($value)
 * @method static \Illuminate\Database\Query\Builder|\Empresa whereObservaciones($value)
 * @method static \Illuminate\Database\Query\Builder|\Empresa whereDeletedAt($value)
 */
class Empresa extends Eloquent {
		
	use SoftDeletingTrait;
	
	protected $guarded = array('id');
	protected $hidden = array('password');
	protected $dates=['deleted_at'];
	protected $softDelete = true;
	
	public function findById($id) {
		return $this->where('id', '=', $id);
	}
	public function getEmpresa($id){
		if($this->find($id)->count()<1) {
			return false;
		}
		else return $this->where('id', '=', $id)->firstOrFail();
	}
	
	
	public function getEmpresabyEmail($email) {
		if($this->where('email', '=', $email)->count()<1) {
			return false;
		}
		else return $this->where('email', '=', $email)->firstOrFail();
	}
	
	public $errors;
	
	public function ofertas() {
			return $this->hasMany('Oferta');
	}

    public function cursos() {

        return $this->hasMany('Curso', 'entidad_solicitante', 'id');
    }
	
	public function provincia() {
			return $this->belongsTo('Provincia');
	}
	
	public function municipio() {
			return $this->belongsTo('Municipio');
	}
	
	public function isValid($data)
	{
		$rules = array(
			'email'     => 'unique:empresas',
			'captcha_sesion' => 'same:captcha_code'
		);
		$messages =  array(
				
				'email.unique'          => 'Existe un registro con ese Email',
				
				'captcha_sesion.same'    => 'Código anti-spam incorrecto'
		);
		
		$validator = Validator::make($data, $rules, $messages);
	
		if ($validator->passes())
		{
			return true;
		}
	
		$this->errors = $validator->errors();
	
		return false;
	}

	public function searchDT($columnas, $term) {
		$_SESSION['columnas']=$columnas;
		$_SESSION['term']=$term;
	    $empresa=$this;
		$empresa=$empresa->where(function($empresa){
			$columnas=$_SESSION['columnas'];
			$term=$_SESSION['term'];
		    for($i=0; $i<count($columnas); $i++) 
		    {
		    	if($columnas[$i]['data']=='provincia') {
		    		$provincias=new Provincia;
					$provincias=$provincias->where('NOMBRE', 'LIKE', '%'.$term.'%')->get();
					foreach($provincias as $provincia) {
						$empresa=$empresa->orWhere('provincia_id', '=', $provincia['id']);
					}
		    	}
				else if($columnas[$i]['data']=='municipio') {
		    		$municipios=new Municipio;
					$municipios=$municipios->where('NOMBRE', 'LIKE', '%'.$term.'%')->get();
					
					foreach($municipios as $municipio) {
						
						$empresa=$empresa->orWhere('municipio_id', '=', $municipio['id']);
					}
		    	}
				else $empresa=$empresa->orWhere($columnas[$i]['data'], 'LIKE', '%'. $term .'%');
		    }
		});
		
	    return $empresa;

	}
	
}
