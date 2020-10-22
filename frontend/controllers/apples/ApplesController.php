<?php

namespace frontend\controllers\apples;


use common\models\apples\AppleRepository;
use common\models\apples\Apples;
use common\models\apples\AppleService;

class ApplesController extends \yii\web\Controller
{
    private $_service;

    public function __construct($id, $module, AppleService $service, $config = [])
    {
        $this->_service = $service;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionCreateApples()
    {
        $applesArray = $this->_service->createApples(5);

        return $this->render('index', [
            'apples' => $applesArray,
        ]);
    }

    public function actionDeleteApples()
    {
        $this->_service->deleteAll();
        return $this->render('index');
    }

}
