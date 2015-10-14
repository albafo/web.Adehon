<?php
/**
 * Created by PhpStorm.
 * User: alvarobanofos
 * Date: 05/10/15
 * Time: 19:47
 */

class Documentos_DocumentosController extends BaseController {

    public function getIndex()
    {
        return View::make("documentos.home");
    }

}