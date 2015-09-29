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
    public static function generateCRUDform($model, $id, $showFields, $fieldsNames = array(), $selectsOptions = array(), $extraParams = array())
    {
        $renderer = new Renderer();
        $modelObject = $model::find($id);
        $extraParams['class'][] = "form-horizontal";
        $extraParams['class'][] = "autoGeneratedCRUDForm";
        $extraParams['role'] = "form";
        $extraParams['method'] = "post";



        $htmlParams = $renderer->generateHtmlParams($extraParams);
        $result = "<form $htmlParams>";


        $result .= $renderer->generate2columnsFormContent($showFields, $modelObject, $fieldsNames, $selectsOptions);


        $result .= "<div class='row form-group text-center'>
						<button class='btn btn-success'>Modificar ficha</button>

					</div>";
        $result .= "</form>";

       $renderer->addCRUDformJS();

        return $result;
    }

    protected function generateGroupForm($name, $group, $fieldPares, $modelObject, $columns, $fieldsNames, $selectsOptions)
    {
        $result = "";

        if($fieldPares % 2 !=0) {
            $columns .= "<div class='col-md-6'></div>";
        }

        $result .=  "<div class='form-group'>$columns</div>";
        $result .= "<div class='col-md-12'><fieldset><legend>$name</legend>";
        $result .= $this->generate2columnsFormContent($group, $modelObject, $fieldsNames, $selectsOptions);
        $result .= "</fieldset></div>";
        return $result;

    }

    protected function generate2columnsFormContent($showFields, $modelObject, $fieldsNames, $selectsOptions)
    {
        $result = "";
        $fieldPares = 0;
        $columns="";
        $options = array();

        foreach($showFields as $field => $type)
        {



            if(is_array($type)) {
                $result .= $this->generateGroupForm($field, $type, $fieldPares, $modelObject, $columns, $fieldsNames, $selectsOptions);
                $fieldPares = 0;

            }
            else {

                if (!isset($fieldsNames[$field]))
                    $fieldsNames[$field] = $field;

                if (isset($selectsOptions[$field]))
                    $options = $selectsOptions[$field];

                $columns .= "<div class='col-md-6'>
                                <label class='col-md-4 control-label' style='padding: 0px;' for='field_$field'>{$fieldsNames[$field]}:</label>
                                <div class='col-md-8'>
                                " . $this->getInputFromType($type, "field_$field", $modelObject->$field, $options) . "
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

        return $result;
    }

    protected function getInputText($inputName, $defaultValue="")
    {
        return '<input type="text" class="form-control" name="'.$inputName.'" id="'.$inputName.'"  value="'.$defaultValue.'">';
    }

    protected function getInputTextArea($inputName, $defaultValue="")
    {
        return '<textarea class="form-control" rows="4" id="'.$inputName.'" name="'.$inputName.'">'.$defaultValue.'</textarea>';
    }

    protected function getInputCheckbox($inputName, $defaultValue=0)
    {
        $selected = "";
        if($defaultValue)
            $selected = "checked";

        return '<input type="checkbox" class="form-control cbr " id="'.$inputName.'" name="'.$inputName.'"  '.$selected.'>';

    }

    protected function getInputDate($inputName, $defaultValue="2018-12-20 00:00:00")
    {
        $defaultValue = \DateSql::changeFromSql($defaultValue);
        return '<input type="text" class="form-control datepicker" data-start-view="2" name="'.$inputName.'" id="'.$inputName.'"  value="'.$defaultValue.'">';

    }

    protected function getSelectField($inputName, $selectOptions, $defaultValue="")
    {
        $result = "<select class='form-control' name='$inputName' id='$inputName' >";
        $options = "";
        foreach($selectOptions as $value => $name)
        {
            $selected = "";
            if($value == $defaultValue)
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

    protected function addJS($script)
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
        return $result;
    }






}