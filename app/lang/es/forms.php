<?php

	$file=storage_path()."/lang-editable.php";
	$str=file_get_contents($file);
	$arr=unserialize($str);
	
	return array(
		'jornadasLaborales'=>$arr['es']['jornadasLaborales'],
		
		'tiposContratos'=>$arr['es']['tiposContratos'],
		
		'mes'=>'mes|meses',
		'salarios'=>'Entre :menor y :mayor',
		'nivelesFormativos'=>$arr['es']['nivelesFormativos'],
		'titulaciones'=>array(
			'3'=>array(
				'1'=>array(
					'Actividades Físicas y Deportivas'=>array(
						'13110'=>'Conducción de Actividades Físico-deportivas en el Medio Natural (LOGSE)'
					)
				),
				
			
				 '2'=>array(
				 	'Administración y Gestión'=>array(
					'13120'=>'Gestión Administrativa (LOGSE)',
					'13121'=>'Gestión Administrativa (LOE)'
					)
				),
				'3'=>array(
					'Agraria'=>array(
						'13130'=>'Explotaciones Agrarias Extensivas (LOGSE)',
				     	'13131'=>'Explotaciones Agrícolas Intensivas (LOGSE)', 
				        '13132'=>'Explotaciones Ganaderas (LOGSE)',
				        '13133'=>'Jardinería (LOGSE)',
				        '13134'=>'Trabajos Forestales y Conservación del Medio Natural (LOGSE)', 
				        '13135'=>'Aprovechamiento y Conservación del Medio Natural (LOE)',
				        '13136'=>'Jardinería y Floristería (LOE)', 
				        '13137'=>'Producción Agroecológica (LOE)', 
				        '13138'=>'Producción Agropecuaria (LOE)'
				        )
					),
					
				
			),
			'4'=>array(
				
					
				'1'=>array('Artes Gráficas'=>array(
					'14110'=>'Encuadernación y Manipulados de Papel y Cartón (LOGSE)', 
			        '14111'=>'Impresión en Artes Gráficas (LOGSE)', 
			        '14112'=>'Preimpresión en Artes Gráficas (LOGSE)',
			        '14113'=>'Impresión Gráfica (LOE)', 
			        '14114'=>'Postimpresión y Acabados Gráficos (LOE)', 
			        '14115'=>'Preimpresión Digital (LOE)' 
			     	)
				),
				'2'=>array('Comercio y Marketing'=>array(
				 	'14120'=>'Comercio Internacional (LOGSE)',
			        '14121'=>'Comercio Internacional (LOE)',
			        '14122'=>'Gestión Comercial y Marketing (LOGSE)',
			        '14123'=>'Gestión del Transporte (LOGSE)',
			        '14124'=>'Servicios al Consumidor (LOGSE)',
			        '14125'=>'Gestión de Ventas y Espacios Comerciales (LOE)',
			        '14126'=>'Marketing y Publicidad (LOE)',
			        '14127'=>'Transporte y Logística (LOE)'
			        )
				)
			)		
		),
		'sinExperiencia'=>'Sin experiencia',
		'anyo'=>'año|años',
		
		'areasEmpleo'=>$arr['es']['areasEmpleo'],
		'horariosLaborales'=>$arr['es']['horariosLaborales'],
		'sexos'=>array(
		'1'=>'Hombre',
		'2'=>'Mujer'),
		'inscrito'=>array(
		'0'=> 'No inscrito',
		'1'=>'Inscrito'),
		
		'nuevaArea'=>'Nueva área de empleo'
	);
/*AREAS DE EMPLEO 
 * <ul class="newList hidden"  style="top: 23px; height: 212px; left: 0px;	">
			      
			      
			      <li id="element_2001" class="suboptions" key="2001">
			        <span class="expand_element">[+]</span><a href="JavaScript:void(0);" class="">Administración de Empresas</a>
			
			        <ul class="hidden">
			          '2001'=>'-Todos Administración de Empresas-',
			
			          '2'=>'Administración y finanzas',
			
			          '3'=>'Auditoría',
			
			          '41'=>'Consultoría general y estratégica',
			
			          '4'=>'Contabilidad',
			
			          '1'=>'Dirección y gerencia',
			
			          '7'=>'Gestión de cobros',
			
			          '5'=>'Reporting y control de gestión',
			
			          '6'=>'Tesorería',
			        </ul>
			      </li>
			
			      <li id="element_2030" class="suboptions" key="2030">
			        <span class="expand_element">[+]</span><a href="JavaScript:void(0);" class=
			        "">Administrativos y secretariado</a>
			
			        <ul class="hidden">
			          '2030'=>'- Todos Administrativos y secretariado-',
			
			          '146'=>'Administrativos',
			
			          '9'=>'Recepcionistas',
			
			          '8'=>'Secretariado',
			        </ul>
			      </li>
			
			      <li id="element_2005" class="suboptions" key="2005">
			        <span class="expand_element">[+]</span><a href="JavaScript:void(0);" class=
			        "">Atención al cliente</a>
			
			        <ul class="hidden">
			          '2005'=>'- Todos Atención al cliente-',
			
			          '138'=>'Atención al cliente no presencial',
			
			          '12'=>'Atención al cliente presencial',
			        </ul>
			      </li>
			
			      <li id="element_2035" class="suboptions" key="2035">
			        <span class="expand_element">[+]</span><a href="JavaScript:void(0);" class=
			        "">Banca y seguros</a>
			
			        <ul class="hidden">
			          '2035'=>'- Todos Banca y seguros-',
			
			          '16'=>'Banca comercial',
			
			          '17'=>'Banca de empresas',
			
			          '15'=>'Banca personal y privada',
			
			          '14'=>'Inversión y mercados financieros',
			
			          '136'=>'Otras - Banca y Seguros',
			
			          '20'=>'Seguros - contratación',
			
			          '18'=>'Seguros - inversión',
			
			          '19'=>'Seguros - siniestros',
			        </ul>
			      </li>
			
			      <li id="element_2007" class="suboptions" key="2007">
			        <span class="expand_element">[+]</span><a href="JavaScript:void(0);" class=
			        "">Calidad, I+D, PRL y medio ambiente</a>
			
			        <ul class="hidden">
			          '2007'=>'- Todos Calidad, I+D, PRL y medio ambiente-',
			
			          '22'=>'Calidad',
			
			          '24'=>'I+D',
			
			          '23'=>'Medio ambiente',
			
			          '25'=>'Prevención de riesgos laborales',
			        </ul>
			      </li>
			
			      <li id="element_2010" class="suboptions" key="2010">
			        <span class="expand_element">[+]</span><a href="JavaScript:void(0);" class=
			        "">Comercial, ventas</a>
			
			        <ul class="hidden">
			          '2010'=>'- Todos Comercial, ventas-',
			
			          '26'=>'Comercial',
			
			          '29'=>'Comercio exterior',
			
			          '28'=>'Desarrollo de negocio y expansión',
			
			          '152'=>'Fuerza de ventas',
			
			          '27'=>'Grandes cuentas',
			
			          '30'=>'Postventa',
			
			          '31'=>'Preventa',
			
			          '139'=>'Promociones y eventos',
			
			          '13'=>'Retail y personal de tienda',
			
			          '140'=>'Televenta',
			        </ul>
			      </li>
			
			      <li id="element_2011" class="suboptions" key="2011">
			        <span class="expand_element">[+]</span><a href="JavaScript:void(0);" class=
			        "">Compras, logística y transporte</a>
			
			        <ul class="hidden">
			          '2011'=>'- Todos Compras, logística y transporte-',
			
			          '36'=>'Almacén',
			
			          '32'=>'Compras y aprovisionamiento',
			
			          '33'=>'Importación',
			
			          '34'=>'Logística, distribución',
			
			          '35'=>'Transporte',
			        </ul>
			      </li>
			
			      <li id="element_2003" class="suboptions" key="2003">
			        <span class="expand_element">[+]</span><a href="JavaScript:void(0);" class=
			        "">Construcción e inmobiliaria</a>
			
			        <ul class="hidden">
			          '2003'=>'- Todos Construcción e inmobiliaria-',
			
			          '37'=>'Arquitectura',
			
			          '38'=>'Edificación y Obra Civil',
			
			          '39'=>'Inmobiliaria',
			        </ul>
			      </li>
			
			      <li id="element_2018" class="suboptions" key="2018">
			        <span class="expand_element">[+]</span><a href="JavaScript:void(0);" class=
			        "">Educación, formación</a>
			
			        <ul class="hidden">
			          '2018'=>'- Todos Educación, formación-',
			
			          '57'=>'Educación de idiomas',
			
			          '56'=>'Educación especial',
			
			          '53'=>'Educación infantil y primaria',
			
			          '54'=>'Educación secundaria y bachillerato',
			
			          '55'=>'Educación superior y de postgrado',
			
			          '58'=>'Otros - Formación',
			        </ul>
			      </li>
			
			      <li id="element_2019" class="suboptions" key="2019">
			        <span class="expand_element">[+]</span><a href="JavaScript:void(0);" class=
			        "">Hostelería, Turismo</a>
			
			        <ul class="hidden">
			          '2019'=>'- Todos Hostelería,Turismo-',
			
			          '59'=>'Hoteles y alojamientos',
			
			          '60'=>'Restauración',
			
			          '61'=>'Turismo',
			        </ul>
			      </li>
			
			      <li id="element_2017" class="suboptions" key="2017">
			        <span class="expand_element">[+]</span><a href="JavaScript:void(0);" class=
			        "">Ingeniería y producción</a>
			
			        <ul class="hidden">
			          '2017'=>'- Todos Ingeniería y producción-',
			
			          '10'=>'Agrónomos, montes y pesca',
			
			          '76'=>'Diseño industrial',
			
			          '78'=>'Fabricación y producción',
			
			          '79'=>'Ingeniería y organización',
			
			          '77'=>'Instalación y mantenimiento',
			
			          '11'=>'Recursos mineros y energéticos',
			
			          '80'=>'Seguridad industrial',
			        </ul>
			      </li>
			
			      <li id="element_2038" class="suboptions" key="2038">
			        <span class="expand_element">[+]</span><a href="JavaScript:void(0);">Internet</a>
			
			        <ul class="hidden">
			          '2038'=>'- Todos Internet-',
			
			          '82'=>'Arquitectura web, usabilidad y diseño',
			
			          '81'=>'Analítica web',
			
			          '147'=>'Comercial on line',
			
			          '83'=>'Contenidos web y blogger',
			
			          '85'=>'Estrategia y desarrollo de negocio on line',
			
			          '148'=>'Legal',
			
			          '149'=>'Marketing de afiliación',
			
			          '86'=>'Marketing on line',
			
			          '150'=>'Posicionamiento en buscadores',
			
			          '84'=>'Programación web',
			
			          '87'=>'Redes Sociales',
			
			          '151'=>'Web trafficker',
			        </ul>
			      </li>
			
			      <li id="element_2023" class="suboptions" key="2023">
			        <span class="expand_element">[+]</span><a href="JavaScript:void(0);" class=
			        "">Legal</a>
			
			        <ul class="hidden">
			          '2023'=>'- Todos Legal-',
			
			          '93'=>'Civil',
			
			          '90'=>'Fiscal',
			
			          '141'=>'Internet',
			
			          '92'=>'Laboral',
			
			          '91'=>'Mercantil',
			
			          '94'=>'Otros - Legal',
			        </ul>
			      </li>
			
			      <li id="element_2026" class="suboptions" key="2026">
			        <span class="expand_element">[+]</span><a href="JavaScript:void(0);" class=
			        "">Marketing y comunicación</a>
			
			        <ul class="hidden">
			          '2026'=>'- Todos Marketing y comunicación-',
			
			          '137'=>'Comunicación y Relaciones Públicas',
			
			          '73'=>'Estrategia y desarrollo de negocio',
			
			          '99'=>'Fidelización',
			
			          '101'=>'Investigación de mercado',
			
			          '98'=>'Marketing',
			
			          '102'=>'Merchandising',
			
			          '104'=>'Producto',
			
			          '103'=>'Publicidad',
			
			          '100'=>'Trade marketing',
			        </ul>
			      </li>
			
			      <li id="element_2012" class="suboptions" key="2012">
			        <span class="expand_element">[+]</span><a href="JavaScript:void(0);" class=
			        "">Medios, editorial y artes gráficas</a>
			
			        <ul class="hidden">
			          '2012'=>'- Todos Medios, editorial y artes gráficas-',
			
			          '109'=>'Diseño y artes gráficas',
			
			          '108'=>'Documentación',
			
			          '107'=>'Editorial',
			
			          '106'=>'Imagen y sonido',
			
			          '105'=>'Periodismo y contenidos',
			        </ul>
			      </li>
			
			      <li id="element_2036" class="suboptions" key="2036">
			        <span class="expand_element">[+]</span><a href="JavaScript:void(0);" class=
			        "">Profesionales, artes y oficios</a>
			
			        <ul class="hidden">
			          '2036'=>'- Todos Profesionales, artes y oficios-',
			
			          '112'=>'Agroalimentario',
			
			          '64'=>'Artes Escénicas',
			
			          '65'=>'Artesanía y artes plásticas',
			
			          '110'=>'Construcción',
			
			          '63'=>'Diseño y Creatividad',
			
			          '111'=>'Industria',
			
			          '115'=>'Limpieza especializada',
			
			          '114'=>'Moda y textil',
			
			          '118'=>'Otros - profesionales, artes y oficios',
			
			          '113'=>'Peluquería y estética',
			
			          '117'=>'Seguridad y vigilancia',
			
			          '116'=>'Servicios',
			
			          '66'=>'Traducción e interpretación',
			        </ul>
			      </li>
			
			      <li id="element_2028" class="suboptions" key="2028">
			        <span class="expand_element">[+]</span><a href="JavaScript:void(0);" class=
			        "">Recursos humanos</a>
			
			        <ul class="hidden">
			          '2028'=>'- Todos Recursos humanos-',
			
			          '120'=>'Administración de personal',
			
			          '121'=>'Formación',
			
			          '122'=>'Relaciones Laborales',
			
			          '119'=>'RRHH',
			
			          '123'=>'Selección',
			        </ul>
			      </li>
			
			      <li id="element_2029" class="suboptions" key="2029">
			        <span class="expand_element">[+]</span><a href="JavaScript:void(0);" class=
			        "">Sanidad, salud y servicios sociales</a>
			
			        <ul class="hidden">
			          '2029'=>'- Todos Sanidad, salud y servicios sociales-',
			
			          '142'=>'Administración y gestión socio-sanitaria',
			
			          '125'=>'Enfermería',
			
			          '127'=>'Farmacia',
			
			          '128'=>'Investigación',
			
			          '144'=>'Medicina alternativa',
			
			          '145'=>'Medicina especializada',
			
			          '124'=>'Medicina general',
			
			          '126'=>'Odontología',
			
			          '131'=>'Otros - sociosanitarias',
			
			          '130'=>'Psicología',
			
			          '129'=>'Servicios Sociales',
			        </ul>
			      </li>
			
			      <li id="element_2021" class="suboptions" key="2021">
			        <span class="expand_element">[+]</span><a href="JavaScript:void(0);" class=
			        "">Tecnología e informática</a>
			
			        <ul class="hidden">
			          '2021'=>'- Todos Tecnología e informática-',
			
			          '69'=>'Análisis y programación',
			
			          '70'=>'Base de datos',
			
			          '71'=>'Calidad y auditoría',
			
			          '47'=>'Consultoría Tecnológica',
			
			          '88'=>'Diseño y maquetación',
			
			          '68'=>'Gestión y dirección de proyectos',
			
			          '72'=>'Otros - Tecnología e Informática',
			
			          '74'=>'Sistemas, redes y seguridad',
			
			          '75'=>'Soporte y explotación',
			        </ul>
			      </li>
			
			      <li id="element_2032" class="suboptions" key="2032">
			        <span class="expand_element">[+]</span><a href="JavaScript:void(0);" class=
			        "">Telecomunicaciones</a>
			
			        <ul class="hidden">
			          '2032'=>'- Todos Telecomunicaciones-',
			
			          '134'=>'Electrónica',
			
			          '133'=>'Radiocomunicación',
			
			          '135'=>'Sonido e imagen',
			
			          '132'=>'Telemática',
			        </ul>
			      </li>
			    </ul>*/


/*
FP GRADO MEDIO
<ul>
   <h3>Actividades Físicas y Deportivas</h3>
   <ul>
       Conducción de Actividades Físico-deportivas en el Medio Natural (LOGSE) 
   </ul>
   <h3>Administración y Gestión</h3>
   <ul>
       Gestión Administrativa (LOGSE) 
       Gestión Administrativa (LOE) 
   </ul>
   <h3>Agraria</h3>
   <ul>
       Explotaciones Agrarias Extensivas (LOGSE) 
       Explotaciones Agrícolas Intensivas (LOGSE) 
       Explotaciones Ganaderas (LOGSE) 
       Jardinería (LOGSE) 
       Trabajos Forestales y Conservación del Medio Natural (LOGSE) 
       Aprovechamiento y Conservación del Medio Natural (LOE) 
       Jardinería y Floristería (LOE) 
       Producción Agroecológica (LOE) 
       Producción Agropecuaria (LOE) 
   </ul>
   <h3>Artes Gráficas</h3>
   <ul>
       Encuadernación y Manipulados de Papel y Cartón (LOGSE) 
       Impresión en Artes Gráficas (LOGSE) 
       Preimpresión en Artes Gráficas (LOGSE) 
       Impresión Gráfica (LOE) 
       Postimpresión y Acabados Gráficos (LOE) 
       Preimpresión Digital (LOE) 
   </ul>
   <h3>Comercio y Marketing</h3>
   <ul>
       Comercio (LOGSE) 
       Actividades Comerciales (LOE) 
   </ul>
   <h3>Edificación y Obra Civil</h3>
   <ul>
       Acabados de Construcción (LOGSE) 
       Obras de Albañilería (LOGSE) 
       Obras de Hormigón (LOGSE) 
       Operación y Mantenimiento de Maquinaria de Construcción (LOGSE) 
       Construccion (LOE) 
       Obras de Interior, Decoración y Rehabilitación (LOE) 
   </ul>
   <h3>Electricidad y Electrónica</h3>
   <ul>
       Equipos Electrónicos de Consumo (LOGSE) 
       Equipos e Instalaciones Electrotécnicas (LOGSE) 
       Instalaciones Eléctricas y Automáticas (LOE) 
       Instalaciones de Telecomunicaciones (LOE) 
   </ul>
   <h3>Fabricación Mecánica</h3>
   <ul>
       Fundición (LOGSE) 
       Joyería (LOGSE) 
       Mecanizado (LOGSE) 
       Mecanizado (LOE) 
       Soldadura y Caldereria (LOGSE) 
       Soldadura y Caldereria (LOE) 
       Tratamientos Superficiales y Térmicos (LOGSE) 
       Conformado por moldeo de metales y polímeros (LOE) 
   </ul>
   <h3>Hostelería y Turismo</h3>
   <ul>
       Cocina (LOGSE) 
       Pastelería y Panadería (LOGSE) 
       Servicios de  Restaurante y Bar (LOGSE) 
       Cocina y Gastronomía (LOE) 
       Servicios en Restauración (LOE) 
   </ul>
   <h3>Imagen Personal</h3>
   <ul>
       Caracterización (LOGSE) 
       Peluquería (LOGSE) 
       Estética y Belleza (LOE) 
       Estética Personal Decorativa (LOE) 
       Peluquería y Cosmética Capilar (LOE) 
   </ul>
   <h3>Imagen y Sonido</h3>
   <ul>
       Laboratorio de Imagen (LOGSE) 
       Video Disc-Jockey y Sonido (LOE) 
   </ul>
   <h3>Industrias Alimentarias</h3>
   <ul>
       Conservería Vegetal, Cárnica y de Pescado (LOGSE) 
       Elaboración de Productos Lácteos (LOGSE) 
       Elaboración de Aceites y jugos (LOGSE) 
       Elaboración de Vinos y Otras Bebidas (LOGSE) 
       Matadero y Carnicería-Charcutería (LOGSE) 
       Molinería e Industrias Cerealistas (LOGSE) 
       Panificación y Repostería (LOGSE) 
       Aceites de Oliva y Vinos (LOE) 
       Elaboración de Productos Alimenticios (LOE) 
       Panadería, Repostería y Confitería (LOE) 
   </ul>
   <h3>Industrias Extractivas</h3>
   <ul>
       Excavaciones y Sondeos (LOE) 
       Piedra Natural (LOE) 
   </ul>
   <h3>Informática y Comunicaciones</h3>
   <ul>
       Explotación de Sistemas Informáticos (LOGSE) 
       Sistemas Microinformáticos y Redes (LOE) 
   </ul>
   <h3>Instalación y Mantenimiento</h3>
   <ul>
       Instalación y Mantenimiento Electromecánico de Maquinaria y Conducción de Líneas (LOGSE) 
       Mantenimiento Ferroviario (LOGSE) 
       Montaje y Mantenimiento de Instalaciones de Frío, Climatización y Producción de Calor (LOGSE) 
       Instalaciones Frigoríficas y de Climatización (LOE) 
       Instalaciones de Producción de Calor (LOE) 
       Mantenimiento Electromecánico (LOE) 
   </ul>
   <h3>Madera, Mueble y Corcho</h3>
   <ul>
       Fabricación Industrial de Carpintería y Mueble (LOGSE) 
       Fabricación a Medida e Instalación de Carpintería y Mueble (LOGSE) 
       Transformación de Madera y Corcho (LOGSE) 
       Carpintería y Mueble (LOE) 
       Instalación y Amueblamiento (LOE) 
   </ul>
   <h3>Marítimo - Pesquera</h3>
   <ul>
       Buceo de Media Profundidad (LOGSE) 
       Operación, Control y Mantenimiento de Máquinas e Instalaciones del Buque (LOGSE) 
       Operaciones de Cultivo Acuícola (LOGSE) 
       Pesca y Transporte Marítimo (LOGSE) 
       Cultivos Acuícolas (LOE) 
       Mantenimiento y Control de la Maquinaria de Buques y Embarcaciones (LOE) 
       Navegación y Pesca de Litoral (LOE) 
       Operaciones Subacuáticas e Hiperbáricas (LOE) 
   </ul>
   <h3>Química</h3>
   <ul>
       Laboratorio (LOGSE) 
       Operaciones de Fabricación de Productos Farmacéuticos (LOGSE) 
       Operaciones de Proceso de Pasta y Papel (LOGSE) 
       Operaciones de Proceso de Planta Química (LOGSE) 
       Operaciones de Transformación de Plásticos y Caucho (LOGSE) 
       Operaciones de Laboratorio (LOE) 
       Planta Química (LOE) 
   </ul>
   <h3>Sanidad</h3>
   <ul>
       Cuidados Auxiliares de Enfermería (LOGSE) 
       Farmacia (LOGSE) 
       Farmacia y Parafarmacia (LOE) 
       Emergencias Sanitarias (LOE) 
   </ul>
   <h3>Seguridad y Medio Ambiente</h3>
   <ul>
       Emergencias y Protección Civil (LOE) 
   </ul>
   <h3>Servicios Socioculturales y a la Comunidad</h3>
   <ul>
       Atención Sociosanitaria (LOGSE) 
       Atención a Personas en Situación de Dependencia (LOE) 
   </ul>
   <h3>Textil, Confección y Piel</h3>
   <ul>
       Calzado y Marroquinería (LOGSE) 
       Confección (LOGSE) 
       Operaciones de Ennoblecimiento Textil (LOGSE) 
       Producción de Hiladura y Tejeduría de Calada (LOGSE) 
       Producción de Tejidos de Punto (LOGSE) 
       Calzado y Complementos de Moda (LOE) 
       Confección y Moda (LOE) 
       Fabricación y Ennoblecimiento de Productos Textiles (LOE) 
   </ul>
   <h3>Transporte y Mantenimiento de Vehículos</h3>
   <ul>
       Carrocería (LOGSE) 
       Carrocería (LOE) 
       Electromecánica de Vehículos (LOGSE) 
       Conducción de Vehículos de Transporte por Carretera (LOE) 
       Electromecánica de Maquinaria (LOE) 
       Electromecánica de Vehículos Automóviles (LOE) 
       Mantenimiento de Material Rodante Ferroviario (LOE) 
   </ul>
   <h3>Vidrio y Cerámica</h3>
   <ul>
       Operaciones de Fabricación de Productos Cerámicos (LOGSE) 
       Operaciones de Fabricación de Vidrio y Transformados (LOGSE) 
       Fabricación de Productos Cerámicos (LOE) 
   </ul>
</ul>*/

/* FP GRADO SUPERIOR 
 * 
 * <h2>Ciclos Formativos de Grado Superior</h2>
   <p>Los ciclos Formativos marcados como LOGSE son ciclos que se encuentran en proceso de actualizacion y serán sustituidos por los ciclos LOE de idéntica o similar denominación.</p>
   <ul>
      <h3>Actividades Físicas y Deportivas</h3>
      <ul>
         Animación de Actividades Físicas y Deportivas (LOGSE)
      </ul>
      <h3>Administración y Gestión</h3>
      <ul>
         Administración y Finanzas (LOGSE)
         Administración y Finanzas (LOE)
         Secretariado (LOGSE)
         Asistencia a la Dirección (LOE)
      </ul>
      <h3>Agraria</h3>
      <ul>
         Gestión y Organización de Empresas Agropecuarias (LOGSE)
         Gestión y Organización de los Recursos Naturales y Paisajísticos (LOGSE)
         Ganadería y Asistencia en Sanidad Animal (LOE)
         Gestión Forestal y del Medio Natural (LOE)
         Paisajismo y Medio Rural (LOE)
      </ul>
      <h3>Artes Gráficas</h3>
      <ul>
         Producción en Industrias de Artes Gráficas (LOGSE)
         Diseño y Producción Editorial (LOGSE)
         Diseño y Edición de Publicaciones Impresas y Multimedia (LOE)
         Diseño y Gestión de la Producción Gráfica (LOE)
      </ul>
      <h3>Artes y Artesanías</h3>
      <ul>
         Artista Fallero y Construcción de Escenografías (LOE)
      </ul>
      <h3>Comercio y Marketing</h3>
      <ul>
         Comercio Internacional (LOGSE)
         Comercio Internacional (LOE)
         Gestión Comercial y Marketing (LOGSE)
         Gestión del Transporte (LOGSE)
         Servicios al Consumidor (LOGSE)
         Gestión de Ventas y Espacios Comerciales (LOE)
         Marketing y Publicidad (LOE)
         Transporte y Logística (LOE)
      </ul>
      <h3>Edificación y Obra Civil</h3>
      <ul>
         Desarrollo de Proyectos Urbanísticos y Operaciones Topográficas (LOGSE)
         Desarrollo y Aplicación de Proyectos de Construcción (LOGSE)
         Realización y Planes de Obra (LOGSE)
         Proyectos de Edificación (LOE)
         Proyectos de Obra Civil (LOE)
      </ul>
      <h3>Electricidad y Electrónica</h3>
      <ul>
         Instalaciones Electrotécnicas (LOGSE)
         Sistemas de Telecomunicación e Informáticos (LOGSE)
         Automatización y Robótica Industrial (LOE)
         Desarrollo de Productos Electrónicos (LOGSE)
         Sistemas de Regulación y Control Automáticos (LOGSE)
         Mantenimiento Electrónico (LOE)
         Sistemas Electrotécnicos y Automatizados (LOE)
         Sistemas de Telecomunicaciones e Informáticos (LOE)
      </ul>
      <h3>Energía y Agua</h3>
      <ul>
         Centrales Eléctricas (LOE)
         Eficiencia Energética y Energía Solar Térmica (LOE)
         Energías Renovables (LOE)
      </ul>
      <h3>Fabricación Mecánica</h3>
      <ul>
         Desarrollo de Proyectos Mecánicos (LOGSE)
         Óptica de Anteojería (LOGSE)
         Producción por Fundición y Pulvimetalurgia (LOGSE)
         Construcciones Metálicas (LOGSE)
         Construcciones Metálicas (LOE)
         Producción por Mecanizado (LOGSE)
         Diseño en Fabricación Mecánica (LOE)
         Programación de la Producción en Fabricación Mecánica (LOE)
         Programación de la Producción en Moldeo de Metales y Polímeros (LOE)
      </ul>
      <h3>Hostelería y Turismo</h3>
      <ul>
         Agencias de Viajes (LOGSE)
         Alojamiento (LOGSE)
         Animación Turística (LOGSE)
         Información y Comercialización Turísticas (LOGSE)
         Restauración (LOGSE)
         Agencias de Viajes y Gestión de Eventos (LOE)
         Dirección de Cocina (LOE)
         Dirección de Servicios de Restauración (LOE)
         Gestión de Alojamientos Turísticos (LOE)
         Guía, Información y Asistencias Turísticas (LOE)
      </ul>
      <h3>Imagen Personal</h3>
      <ul>
         Asesoría de Imagen Personal (LOGSE)
         Estética (LOGSE)
         Asesoría de Imagen Personal y Corporativa (LOE)
         Caracterización y Maquillaje Profesional (LOE)
         Estética Integral y Bienestar (LOE)
         Estilismo y Dirección de Peluquería (LOE)
      </ul>
      <h3>Imagen y Sonido</h3>
      <ul>
         Imagen (LOGSE)
         Producción de Audiovisuales, Radio y Espectáculos (LOGSE)
         Realización de Audiovisuales y Espectáculos (LOGSE)
         Sonido (LOGSE)
         Animaciones 3D, Juegos y Entornos Interactivos (LOE)
         Iluminación, Captación y Tratamiento de la Imagen (LOE)
         Producción de Audiovisuales y Espectáculos (LOE)
         Realización de Proyectos Audiovisuales y Espectáculos (LOE)
         Sonido para Audiovisuales y Espectáculos (LOE)
      </ul>
      <h3>Industrias Alimentarias</h3>
      <ul>
         Industria Alimentaria (LOGSE)
         Procesos y Calidad en la Industria Alimentaria (LOE)
         Vitivinicultura (LOE)
      </ul>
      <h3>Informática y Comunicaciones</h3>
      <ul>
         Desarrollo de Aplicaciones Informáticas (LOGSE)
         Administración de Sistemas Informáticos (LOGSE)
         Administración de Sistemas Informáticos en Red (LOE)
         Desarrollo de Aplicaciones Multiplataforma (LOE)
         Desarrollo de Aplicaciones Web (LOE)
      </ul>
      <h3>Instalación y Mantenimiento</h3>
      <ul>
         Desarrollo de Proyectos de Instalaciones de Fluídos, Térmicas y de Manutención (LOGSE)
         Mantenimiento de Equipo Industrial (LOGSE)
         Mantenimiento y Montaje de Instalaciones de Edificio y Proceso (LOGSE)
         Prevención de Riesgos Profesionales (LOGSE)
         Desarrollo de Proyectos de Instalaciones Térmicas y de Fluidos (LOE)
         Mantenimiento de Instalaciones Térmicas y de Fluidos (LOE)
         Mecatrónica Industrial (LOE)
      </ul>
      <h3>Madera, Mueble y Corcho</h3>
      <ul>
         Desarrollo de Productos en Carpintería y Mueble (LOGSE)
         Producción de Madera y Mueble (LOGSE)
         Diseño y Amueblamiento (LOE)
      </ul>
      <h3>Marítimo - Pesquera</h3>
      <ul>
         Navegación, Pesca y Transporte Marítimo (LOGSE)
         Producción Acuícola (LOGSE)
         Supervisión y Control de Máquinas e Instalaciones del Buque (LOGSE)
         Acuicultura (LOE)
         Organización del Mantenimiento de Maquinaria de Buques y Embarcaciones (LOE)
         Transporte Marítimo y Pesca de Altura (LOE)
      </ul>
      <h3>Química</h3>
      <ul>
         Análisis y Control (LOGSE)
         Fabricación de Productos Farmacéuticos y Afines (LOGSE)
         Industrias de Proceso de Pasta y Papel (LOGSE)
         Industrias de Proceso Químico (LOGSE)
         Plásticos y Caucho (LOGSE)
         Química Ambiental (LOGSE)
         Laboratorio de Análisis y de Control de Calidad (LOE)
         Química Industrial (LOE)
      </ul>
      <h3>Sanidad</h3>
      <ul>
         Audioprótesis (LOGSE)
         Audiología Protésica (LOE)
         Anatomía Patológica y Citología (LOGSE)
         Dietética (LOGSE)
         Documentación Sanitaria (LOGSE)
         Higiene Bucodental (LOGSE)
         Imagen para el Diagnóstico (LOGSE)
         Laboratorio de Diagnóstico Clínico (LOGSE)
         Ortoprotésica (LOGSE)
         Ortoprótesis y Productos de Apoyo (LOE)
         Prótesis Dentales (LOGSE)
         Prótesis Dentales (LOE)
         Radioterapia (LOGSE)
         Salud Ambiental (LOGSE)
      </ul>
      <h3>Seguridad y Medio Ambiente</h3>
      <ul>
         Educación y Control Ambiental (LOE)
         Coordinación de Emergencias y Protección Civil (LOE)
      </ul>
      <h3>Servicios Socioculturales y a la Comunidad</h3>
      <ul>
         Animación Sociocultural (LOGSE)
         Animación Sociocultural y Turística (LOE)
         Educación Infantil (LOGSE)
         Educación Infantil (LOE)
         Integración Social (LOGSE)
         Promoción de Igualdad de Género (LOE)
         Integración Social (LOE)
         Interpretación de la Lengua de Signos (LOGSE)
      </ul>
      <h3>Textil, Confección y Piel</h3>
      <ul>
         Curtidos (LOGSE)
         Procesos de Confección Industrial (LOGSE)
         Patronaje (LOGSE)
         Procesos de Ennoblecimiento Textil (LOGSE)
         Procesos Textiles de Hilatura y Tejeduría de Calada (LOGSE)
         Procesos Textiles de Tejeduría de Punto (LOGSE)
         Diseño y Producción de Calzado y Complementos (LOE)
         Diseño Técnico en Textil y Piel (LOE)
         Patronaje y Moda (LOE)
         Vestuario a Medida y de Espectáculos (LOE)
      </ul>
      <h3>Transporte y Mantenimiento de Vehículos</h3>
      <ul>
         Automoción (LOGSE)
         Automoción (LOE)
         Mantenimiento Aeromecánico (LOGSE)
         Mantenimiento de Aviónica (LOGSE)
      </ul>
      <h3>Vidrio y Cerámica</h3>
      <ul>
         Desarrollo y Fabricación de Productos Cerámicos (LOGSE)
         Desarrollo y Fabricación de Productos Cerámicos (LOE)
         Fabricación y Transformación de Productos de Vidrio (LOGSE)
      </ul>
   </ul>
 */
