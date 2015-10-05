<?xml version="1.0" encoding="ISO-8859-1"?>
<ENVIO_ENPI xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="XML_ENPI_v1.1.xsd">
    <ENVIO_MENSUAL>
        <CODIGO_AGENCIA>{{utf8_decode($data["cod_agencia"])}}</CODIGO_AGENCIA>
        <AÑO_MES_ENVIO>{{utf8_decode($data["anyomes"])}}</AÑO_MES_ENVIO>
        <ACCIONES_REALIZADAS>
            @foreach($data["acciones"] as $trabajador)
            <ACCION>
                <ID_TRABAJADOR>{{utf8_decode($trabajador["nif"])}}</ID_TRABAJADOR>
                <NOMBRE_TRABAJADOR>{{utf8_decode($trabajador["nombre"])}}</NOMBRE_TRABAJADOR>
                <APELLIDO1_TRABAJADOR>{{utf8_decode($trabajador["apellido1"])}}</APELLIDO1_TRABAJADOR>
                <APELLIDO2_TRABAJADOR>{{utf8_decode($trabajador["apellido2"])}}</APELLIDO2_TRABAJADOR>
                <FECHA_NACIMIENTO>{{utf8_decode($trabajador["fecha_nacimiento"])}}</FECHA_NACIMIENTO>
                <SEXO_TRABAJADOR>{{utf8_decode($trabajador["sexo"])}}</SEXO_TRABAJADOR>
                <NIVEL_FORMATIVO>{{utf8_decode($trabajador["nivel_formativo"])}}</NIVEL_FORMATIVO>
                <DISCAPACIDAD>{{utf8_decode($trabajador["discapacidad"])}}</DISCAPACIDAD>
                <INMIGRANTE>{{utf8_decode($trabajador["inmigrante"])}}</INMIGRANTE>
                <COLOCACION>{{utf8_decode($trabajador["colocacion"])}}</COLOCACION>
            </ACCION>
            @endforeach

        </ACCIONES_REALIZADAS>
        <DATOS_AGREGADOS>
            <TOTAL_PERSONAS>4</TOTAL_PERSONAS>
            <TOTAL_NUEVAS_REGISTRADAS>4</TOTAL_NUEVAS_REGISTRADAS>
            <TOTAL_PERSONAS_PERCEPTORES>1</TOTAL_PERSONAS_PERCEPTORES>
            <TOTAL_PERSONAS_INSERCION>1</TOTAL_PERSONAS_INSERCION>
            <TOTAL_OFERTAS>1</TOTAL_OFERTAS>
            <TOTAL_OFERTAS_ENVIADAS>0</TOTAL_OFERTAS_ENVIADAS>
            <TOTAL_OFERTAS_CUBIERTAS>0</TOTAL_OFERTAS_CUBIERTAS>
            <TOTAL_PUESTOS>0</TOTAL_PUESTOS>
            <TOTAL_PUESTOS_CUBIERTOS>0</TOTAL_PUESTOS_CUBIERTOS>
            <TOTAL_CONTRATOS>0</TOTAL_CONTRATOS>
            <TOTAL_CONTRATOS_INDEFINIDOS>0</TOTAL_CONTRATOS_INDEFINIDOS>
            <TOTAL_PERSONAS_COLOCADAS>0</TOTAL_PERSONAS_COLOCADAS>
        </DATOS_AGREGADOS>
    </ENVIO_MENSUAL>
</ENVIO_ENPI>