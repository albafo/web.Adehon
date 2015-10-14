<div class="tab-pane active" id="xmlSepe">
    <div class="panel panel-default panel-border">

        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <fieldset>
                        <legend>Exportación mensual de datos SEPE (XML)</legend>
                        <form role="form" class="form-horizontal" action="{{url('xml/mes-sepe')}}" method="post">
                            <div class="row form-group">
                                <div class="col-md-6">
                                    <label class="col-md-4 control-label" for="mes">Mes:</label>
                                    <div class="col-md-8">
                                        <select class="form-control" id="mes" name="mes">
                                            <option value="1">Enero</option>
                                            <option value="2">Feberero</option>
                                            <option value="3">Marzo</option>
                                            <option value="4">Abril</option>
                                            <option value="5">Mayo</option>
                                            <option value="6">Junio</option>
                                            <option value="7">Julio</option>
                                            <option value="8">Agosto</option>
                                            <option value="9">Septiembre</option>
                                            <option value="10">Octubre</option>
                                            <option value="11">Noviembre</option>
                                            <option value="12">Diciembre</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="col-md-4 control-label" for="anyo">Año:</label>
                                    <div class="col-md-8">
                                        <input type="number" min="1111" max="9999" class="form-control" id="anyo" name="anyo">
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group text-center">
                                <button id="btnModificar" class="btn btn-success">Mostrar XML</button>

                            </div>
                        </form>
                    </fieldset>

                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <fieldset>
                        <legend>Exportación anual de datos SEPE (XML)</legend>
                        <form role="form" class="form-horizontal" id="formCurso">
                            <div class="row form-group">

                                <div class="col-md-12">
                                    <label class="col-md-4 control-label" for="anyo">Año:</label>
                                    <div class="col-md-4">
                                        <input type="number" min="1111" max="9999" class="form-control" id="anyo" name="anyo">
                                    </div>
                                </div>
                            </div>
                            <div class="row form-group text-center">
                                <button id="btnModificar" class="btn btn-success">Mostrar XML</button>

                            </div>
                        </form>
                    </fieldset>

                </div>
            </div>

        </div>
    </div>

</div>