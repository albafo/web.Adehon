<?php
/**
 * Created by PhpStorm.
 * User: alvarobanofos
 * Date: 13/09/15
 * Time: 18:38
 */

class AjaxListController extends BaseController
{

    public function getAdd($parentModel, $relation, $idParentModel)
    {
        $parentList = $parentModel::find($idParentModel);
        $relation = $parentList->$relation();
        $sonModel = $relation->getRelated();
        $sonList = new $sonModel;
        $fk = $relation->getForeignKey();
        $sonList->$fk = $idParentModel;
        $sonList->save();
        $renderer = new Renderer();
        if(!($tableParams = Session::get($renderer::PREFIX_SESSION_AJAX_LIST.$_GET["listToken"])))
            $result = "<span>Error al actualizar tabla, por favor, recargue la página</span>";
        else {
            $result = $renderer->generateAjaxListFromRelation($tableParams[0], $tableParams[1], $tableParams[2], $tableParams[3], $tableParams[4], $tableParams[5]);

        }
        return json_encode($result);


    }

    public function getEdit($parentModel, $relation, $idRow)
    {
        $parentList = new $parentModel;
        $relation = $parentList->$relation();
        $sonModel = $relation->getRelated();
        $sonObject = $sonModel::find($idRow);
        $fieldName = Request::get("field");
        $fieldValue = Request::get("value");
        if(isset($_GET['valuesToChange'])) {
            if ($_GET['valuesToChange'] == Renderer::INPUT_DATE)
                $fieldValue = DateSql::changeToSql($fieldValue);
        }
        $sonObject->$fieldName = $fieldValue;
        $sonObject->save();
    }

    public function getRemove($parentModel, $relation, $idRow)
    {
        $parentList = new $parentModel;
        $relation = $parentList->$relation();
        $sonModel = $relation->getRelated();
        $sonObject = $sonModel::find($idRow);
        $sonObject->delete();
        return json_encode("ok");
    }
}