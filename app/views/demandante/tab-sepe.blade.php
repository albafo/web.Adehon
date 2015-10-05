<div class="tab-pane" id="sepe">
    <div class="panel panel-default panel-border">
        <div class="panel-body">
        {{
        Renderer::generateCRUDform("Demandante", $data->id,
            array(
                "sepe" => Renderer::INPUT_CHECKBOX,
                "fecha_sepe" => Renderer::INPUT_DATE,
                "carnet_conducir[]" => Renderer::SELECT2MULTIPLE_FROM_SET,
                "disponibilidad" => Renderer::SELECT,
                "vehiculo_propio" => Renderer::INPUT_CHECKBOX,
                "recepcion_circulares" => Renderer::INPUT_CHECKBOX,
                "inmigrante" => Renderer::INPUT_CHECKBOX,
                "receptor_prestaciones" => Renderer::INPUT_CHECKBOX,
                "tipo_prestaciones" => Renderer::SELECT,
                "discapacidad" => Renderer::SELECT
            ),
            array(
                "sepe" => "Incluir en el SEPE",
                "fecha_sepe" => utf8_encode("Fecha inscripción SEPE"),
                "carnet_conducir[]" => "Carnet de conducir",
                "disponibilidad" => "Disponibilidad",
                "vehiculo_propio" => utf8_encode("Vehículo propio"),
                "recepcion_circulares" => utf8_encode("Recepción de circulares"),
                "inmigrante" => "Inmigrante",
                "receptor_prestaciones" => "Receptor de prestaciones",
                "tipo_prestaciones" => "Tipo de prestaciones",
                "discapacidad" => "Grado de discapacidad"
            ),
            array(
                "carnet_conducir[]" => array(
                    'B1-B'=>'B1-B',
                    'A2-A'=>'A2-A',
                    'D1'=>'D1',
                    'LCC'=>'LCC',
                    'B2-TCP'=>'B2-TCP',
                    'C2-C'=>'C2-C',
                    'E'=>'E',
                    'A2'=>'A2',
                    'ADR'=>'ADR',
                    'D'=>'D',
                    'C1'=>'C1'
                ),
                "disponibilidad" => array(
                    'Indiferente' => 'Indiferente',
                    utf8_encode('Mañana y tarde') => utf8_encode('Mañana y tarde'),
                    'Media jornada' => 'Media jornada',
                    'Intensiva' => 'Intensiva',
                    'Turnos' => 'Turnos',
                    'Fin de semana' => 'Fin de semana',
                    'Festivos' => 'Festivos'

                ),
                "tipo_prestaciones" => array(
                    utf8_encode('Ninguna')=>utf8_encode('Ninguna'),
                    utf8_encode('Prestación por desempleo')=>utf8_encode('Prestación por desempleo'), 
                    utf8_encode('Subsidio por desempleo por causas familiares')=>utf8_encode('Subsidio por desempleo por causas familiares'), 
                    utf8_encode('Subsidio mayores de 45 años (RAI)')=>utf8_encode('Subsidio mayores de 45 años (RAI)'), 
                    utf8_encode('PREPARA')=>utf8_encode('PREPARA')
                ),
                "discapacidad" => array(
                    utf8_encode('Sin discapacidad')=>utf8_encode('Sin discapacidad'), 
                    utf8_encode('Grado 0')=>utf8_encode('Grado 0'), 
                    utf8_encode('Grado 1')=>utf8_encode('Grado 1'), 
                    utf8_encode('Grado 2')=>utf8_encode('Grado 2'), 
                    utf8_encode('Grado 3')=>utf8_encode('Grado 3'), 
                    utf8_encode('Grado 4')=>utf8_encode('Grado 4'), 
                    utf8_encode('Grado 5')=>utf8_encode('Grado 5')
                )
                
            )
        )
        }}
        </div>
    </div>
</div>
