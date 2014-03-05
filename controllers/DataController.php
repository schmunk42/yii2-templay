<?php
/**
 * Created by PhpStorm.
 * User: tobias
 * Date: 05.03.14
 * Time: 12:36
 */

namespace schmunk42\templay\controllers;


use schmunk42\templay\models\Data;

class DataController extends \yii\base\Controller {

    public function actionSave() {

        $data = $_POST;

        $model = new Data();
        $model->module = null;
        $model->controller = "site";
        $model->action = "static";
        $model->param = "test/templay";
        $model->tid = $_POST['tid'];

        unset($data['_csrf']);
        unset($data['tid']);

        $model->data = json_encode($data);
        $model->save();

        var_dump($_GET);
        var_dump($_POST);
        var_dump($model->errors);

    }

} 