<?php
/**
 * Created by PhpStorm.
 * User: alvarobanofos
 * Date: 12/09/15
 * Time: 16:31
 */

namespace Biblioteca\Render;

class Renderer {

    const INPUT_TEXT = "text";
    const INPUT_TEXTAREA = "textarea";
    const INPUT_DATE = "date";
    const INPUT_CHECKBOX = "checkbox";
    const SELECT = "select";
    const SELECT2 = "select2";
    const SELECT2MULTIPLE = "select2multiple";


    const PREFIX_SESSION_AJAX_LIST = "ajaxList-";
    protected static $jsScripts = array();




    /**
     * @param $title
     * @param $parentModel
     * @param $relation
     * @param string $identityKey
     */
    public static function generateAjaxListFromRelation($title, $parentModel, $relation, $showFields = array(), $headerNames = array())
    {
        /* @var $relation \Illuminate\Database\Eloquent\Relations\HasMany */
        $relationName = $relation;

        $relation = $parentModel->$relation();


        $renderer = new Renderer();
        $headers = array();
        $arrayTable = array();
        $paramsRows = array();

        $tableParams['data-parent-id'] = $parentModel->getKey();
        $tableParams['data-controller'] = url('ajax-list');
        $tableParams['data-params'] = get_class($parentModel).'/'.$relationName;
        $tableParams['data-token'] = md5($title);


        $result = '<div class="row ajaxListContainer">
            <div class="col-md-12">
                <fieldset>
                    <legend>
                        '.$title.'
                    </legend>



                    <div class="row">
                        <div class="col-md-12 ajaxList">';


        if($relation->count()>0)
        {



            foreach($relation->get() as $row)
            {
                $inputs = $renderer->getInputsFromRow($row, $showFields);
                $rowTable = array();
                foreach($inputs as $fieldName => $htmlInput)
                {
                    $rowTable[$fieldName] = $htmlInput;
                    $headers[$fieldName] = $fieldName;
                    if(isset($headerNames[$fieldName]))
                        $headers[$fieldName] = $headerNames[$fieldName];
                }
                $rowTable['acciones'] = '<i style="cursor: pointer;" class="fa fa-remove removeListRow"></i>';
                $rowParams['data-id'] = $row->getKey();


                $paramsRows[] = $rowParams;
                $arrayTable[] = $rowTable;


            }
            $headers['acciones'] = "Acciones";
            $ajaxListParams = array($title, $parentModel, $relationName, $showFields, $headerNames);
            \Session::set(self::PREFIX_SESSION_AJAX_LIST.$tableParams['data-token'], $ajaxListParams);
        }

        $table = $renderer->generateTable($headers, $arrayTable, $tableParams, $paramsRows);
        $result .= $table;

        $result .= ' <button class="btn addItem">Añadir item</button>

                        </div>
                    </div>
                </fieldset>
                <hr>
            </div>
        </div>';

        return $result;


    }


    /**
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param $id
     * @param $showFields
     * @param array $fieldsNames
     * @param array $selectsOptions
     * @param array $extraParams
     * @return string
     */
    public static function generateCRUDform($model, $id, $showFields, $fieldsNames = array(), $selectsOptions = array(), $extraParams = array(), $defaultValues = array())
    {
        $renderer = new Renderer();
        $modelObject = $model::find($id);
        $extraParams['class'][] = "form-horizontal";
        $extraParams['class'][] = "autoGeneratedCRUDForm";
        $extraParams['role'] = "form";
        $extraParams['method'] = "post";

        Renderer::addJS("
        <script>
            $(function(){
                $('.autoGeneratedCRUDForm').on('submit', function(e){
                    var form = $(this);
                    $('.autoGeneratedCRUDForm input[type=checkbox]').each(function()
                    {
                        if($(this).prop('checked')) {
                            form.append('<input type=\"hidden\" name=\"'+$(this).attr('name')+'\" value=\"1\">');
                        }
                        else form.append('<input type=\"hidden\" name=\"'+$(this).attr('name')+'\" value=\"0\">');
                        $(this).remove();
                    });
                    return true;
                });
            });
        </script>
        ");



        $htmlParams = $renderer->generateHtmlParams($extraParams);
        $result = "<form $htmlParams>";


        $result .= $renderer->generate2columnsFormContent($showFields, $modelObject, $fieldsNames, $selectsOptions, $defaultValues);


        $result .= "<div class='row form-group text-center'>
						<button class='btn btn-success'>Modificar ficha</button>

					</div>";
        $result .= "</form>";

        $result .= $renderer->renderJS();

        return $result;
    }

    protected function generateGroupForm($name, $group, $fieldPares, $modelObject, $columns, $fieldsNames, $selectsOptions, $defaultValues = array())
    {
        $result = "";

        if($fieldPares % 2 !=0) {
            $columns .= "<div class='col-md-6'></div>";
        }

        $result .=  "<div class='form-group'>$columns</div>";
        $result .= "<div class='col-md-12'><fieldset><legend>$name</legend>";
        $result .= $this->generate2columnsFormContent($group, $modelObject, $fieldsNames, $selectsOptions, $defaultValues);
        $result .= "</fieldset></div>";
        return $result;

    }

    protected function generate2columnsFormContent($showFields, $modelObject, $fieldsNames, $selectsOptions, $defaultValues=array())
    {

        $result = "";
        $fieldPares = 0;
        $columns="";

        foreach($showFields as $field => $type)
        {


            $options = array();

            if(is_array($type)) {
                $result .= $this->generateGroupForm($field, $type, $fieldPares, $modelObject, $columns, $fieldsNames, $selectsOptions, $defaultValues);
                $fieldPares = 0;

            }
            else {

                if (!isset($fieldsNames[$field]))
                    $fieldsNames[$field] = $field;

                if (isset($selectsOptions[$field]))
                    $options = $selectsOptions[$field];

                $defaultValue = $modelObject->$field;
                if(isset($defaultValues[$field]))
                    $defaultValue = $defaultValues[$field];

                $inputName = $this->generateInputName($field);
                $columns .= "<div class='col-md-6'>
                                <label class='col-md-4 control-label' style='padding: 0px;' for='field_".self::generateInputId($field)."'>{$fieldsNames[$field]}:</label>
                                <div class='col-md-8'>
                                " . $this->getInputFromType($type, self::generateInputName($field), $defaultValue, $options) . "
                                </div>
                            </div>";
                $fieldPares++;


                if ($fieldPares % 2 == 0 && $fieldPares != 0) {
                    $row = "<div class='form-group'>$columns</div>";
                    $result .= $row;
                    $columns = "";
                }
            }

        }

        if($fieldPares %2 != 0) {
            $row = "<div class='form-group'>$columns</div>";
            $result .= $row;
        }

        return $result;
    }





    /**
     * @param $row
     * @param array $fields
     * @return array
     */
    protected function getInputsFromRow($row, $fields = array())
    {
        $result = array();
        foreach($fields as $field=>$inputType)
        {

            if(isset($names[$field]))
                $name = $names[$field];

            if($inputType == self::INPUT_TEXT)
                $result[$field] = $this->getInputText($field, $row->$field);

            if($inputType == self::INPUT_TEXTAREA)
                $result[$field] = $this->getInputTextarea($field, $row->$field);

            if($inputType == self::INPUT_CHECKBOX)
                $result[$field] = $this->getInputCheckbox($field, $row->$field);

            if($inputType == self::INPUT_DATE)
                $result[$field] = $this->getInputDate($field, $row->$field);


        }

        return $result;
    }

    protected function getInputFromType($inputType, $inputName, $defualtValue = "", $selectOptions = array())
    {

        $result = "";
        if($inputType == self::INPUT_TEXT)
            $result = $this->getInputText($inputName, $defualtValue);

        if($inputType == self::INPUT_TEXTAREA)
            $result = $this->getInputTextarea($inputName, $defualtValue);

        if($inputType == self::INPUT_CHECKBOX)
            $result = $this->getInputCheckbox($inputName, $defualtValue);

        if($inputType == self::INPUT_DATE)
            $result = $this->getInputDate($inputName, $defualtValue);

        if($inputType == self::SELECT)
            $result = $this->getSelectField($inputName, $selectOptions, $defualtValue);

        if($inputType == self::SELECT2)
            $result = $this->getSelect2Field($inputName, $selectOptions, $defualtValue);

        if($inputType == self::SELECT2MULTIPLE)
            $result = $this->getSelect2Field($inputName, $selectOptions, $defualtValue, true);

        return $result;
    }

    protected function getInputText($inputName, $defaultValue="")
    {
        return '<input type="text" class="form-control" name="'.$inputName.'" id="'.self::generateInputId($inputName).'"  value="'.$defaultValue.'">';
    }

    protected function getInputTextArea($inputName, $defaultValue="")
    {
        return '<textarea class="form-control" rows="4" id="'.self::generateInputId($inputName).'" name="'.$inputName.'">'.$defaultValue.'</textarea>';
    }

    protected function getInputCheckbox($inputName, $defaultValue=0)
    {
        $selected = "";
        if($defaultValue)
            $selected = "checked";

        return '<input type="checkbox" class="form-control cbr " id="'.self::generateInputId($inputName).'" name="'.$inputName.'"  '.$selected.'>';

    }

    protected function getInputDate($inputName, $defaultValue="2018-12-20 00:00:00")
    {
        $defaultValue = \DateSql::changeFromSql($defaultValue);
        return '<input type="text" class="form-control datepicker" data-start-view="2" name="'.$inputName.'" id="'.self::generateInputId($inputName).'"  value="'.$defaultValue.'">';

    }

    protected function getSelect2Field($inputName, $selectOptions, $defaultValue="", $multiple = false)
    {
        $result = $this->getSelectField($inputName, $selectOptions, $defaultValue, $multiple);
        $inputIdName = self::generateInputId($inputName);
        $this->addJS("
            <script>
                $(function() {
                    $('#$inputIdName').select2({
                    });
                });

            </script>

        ");
        if($multiple)
            $result .= "<input type='hidden' value='multi-dummy' name='$inputName'>";
        return $result;


    }

    protected function getSelectField($inputName, $selectOptions, $defaultValue="", $multiple = false, $extraParams = array())
    {
        $extraParams["class"][] = "form-control";

        $dataValues = "";
        if(is_array($defaultValue)) {
            $dataValues = implode(",", $defaultValue);
        }

        $extraParams["data-value"][] = $dataValues;

        $htmlParams = $this->generateHtmlParams($extraParams);

        if($multiple)
            $multiple = "multiple";
        $result = "<select $htmlParams $multiple name='$inputName' id='".self::generateInputId($inputName)."' >";
        $options = "";
        foreach($selectOptions as $value => $name)
        {
            $selected = "";
            if((is_array($defaultValue) && in_array($value, $defaultValue)) || (!is_array($defaultValue) && $value == $defaultValue))
                $selected = "selected";
            $options .= "<option value='$value' $selected>$name</option>";
        }
        $result .= $options;
        $result .= "</select>";
        return $result;
    }


    protected function generateCell($content)
    {
        return '<td>'.$content.'</td>';
    }

    protected function generateHeaderCell($content)
    {
        return '<th>'.$content.'</th>';
    }

    protected function generateRow($cells = array(), $params = array())
    {
        $params = $this->generateHtmlParams($params);
        $result = "<tr $params>";
        foreach($cells as $cell)
        {
            $result .= $cell;
        }
        $result .= "</tr>";
        return $result;
    }

    public function generateTable($headers = array(), $arrayTable = array(), $params=array(), $dataParams = array())
    {
        $params['class'][] = "table table-bordered table-striped";

        $params = $this->generateHtmlParams($params);

        $result = '<table '.$params.'>';
        $headerCells = array();
        foreach($headers as $index=>$header)
        {
            $headerCells[] = $this->generateHeaderCell($header);
        }
        $result .= $this->generateRow($headerCells);


        foreach($arrayTable as $indexRow=>$row)
        {

            $cells = array();
            foreach($headers as $index=>$header)
            {

                $cells[] = $this->generateCell($row[$index]);
            }

            if(!isset($dataParams[$indexRow]))
                $dataParams[$indexRow] = array();
            $result .= $this->generateRow($cells, $dataParams[$indexRow]);
        }

        $result .= "</table>";

        return $result;




    }

    protected function generateHtmlParams($params = array())
    {
        $paramsHtml = "";
        foreach($params as $paramName => $paramsArray)
        {
            $paramsHtml .= " $paramName=\"";
            if(is_array($paramsArray))
                foreach($paramsArray as $paramValue)
                {
                    $paramValue = str_replace("\"", "'", $paramValue);
                    $paramsHtml .= "$paramValue";
                    if(count($paramsArray)>1)
                        $paramsHtml .= " ";
                }
            else $paramsHtml .= $paramsArray;
            $paramsHtml .=  "\" ";
        }
        return $paramsHtml;
    }

    protected function addCRUDformJS()
    {
        $this->addJS(
         "<script>
                    $(function(){


                        $('.autoGeneratedCRUDForm').on('submit', function(e){
                            var form = $(this);
                            form.find('input[type=checkbox]').each(function()
                            {

                                if($(this).prop('checked')) {
                                    form.append('<input type=\"hidden\" name=\"'+$(this).attr('name')+'\" value=\"1\">');
                                }
                                else form.append('<input type=\"hidden\" name=\"'+$(this).attr('name')+'\" value=\"0\">');
                                $(this).remove();

                            });
                            return true;
                        });
                    })
                </script>"
        );
    }

    protected static function addJS($script)
    {
        if(!in_array($script, self::$jsScripts))
            self::$jsScripts[] = $script;
    }

    public static function renderJS()
    {
        $result = "";
        foreach(self::$jsScripts as $script)
        {
            $result .= $script;
        }
        self::$jsScripts = array();
        return $result;
    }


    public static function getSelectOptionsArray($model, $value, $toString, $conditions = null)
    {
        $model = new $model();

        if($conditions)
            $modelItems = $model::whereRaw($conditions)->get();
        else $modelItems = $model::all();

        $result = array();
        foreach($modelItems as $item) {
            $result[$item->$value] = $item->$toString;
        }
        return $result;
    }


    public static function getSelectOptionsOnChange($changeElement, $refreshElement, $actionUrl)
    {
        self::addJS("
            <script>
                $(function() {
                    $(document).on('change', '#field_".self::generateInputId($changeElement)."', function(){
                        $.getJSON('$actionUrl'+'/'+$(this).val(), {}, function(data) {
                            $('#field_".self::generateInputId($refreshElement)." option').remove();
                            $.each(data, function(index, value) {
                                var selected = '';
                                if(values.indexOf(index) != -1)
                                    selected = 'selected';
                                $('#field_".self::generateInputId($refreshElement)."').append('<option '+selected+'  value=\"'+index+'\">'+value+'</option>');
                            });
                            $('#field_".self::generateInputId($refreshElement)."').trigger('change');

                        });
                    });

                    var values = $('#field_".self::generateInputId($refreshElement)."').attr('data-value').split(',');
                    $('#field_".self::generateInputId($changeElement)."').trigger('change');


                });
            </script>
        ");

        return array();
    }

    protected static function generateInputName($fieldName)
    {

        return "field_$fieldName";

    }

    protected static function generateInputId($fieldName)
    {
        $field = str_replace("[", "_", $fieldName);
        $field = str_replace("]", "", $field);
        return "field_$field";
    }





}