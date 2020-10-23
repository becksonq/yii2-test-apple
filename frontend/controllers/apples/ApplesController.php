<?php

namespace frontend\controllers\apples;


use Yii;
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
        $applesArray = $this->_service->findAll();
        return $this->render('index', [
            'apples' => $applesArray,
        ]);
    }

    public function actionCreateApples()
    {
        $this->_service->createApples(rand(3, 10));

        return $this->redirect('index');
    }

    public function actionDeleteApples()
    {
        $this->_service->deleteAll();

        return $this->redirect('index');
    }

    public function actionFallDown($id)
    {
        $model = $this->_service->findOne($id);
        $this->_service->changeStatus($model->id);

        $applesArray = $this->_service->findAll();
        return $this->render('index', [
            'apples' => $applesArray,
        ]);
    }

    public function actionEat($id)
    {
        /** @var Apples $model */
        $model = $this->_service->findOne($id);
        if ($model->status == Apples::ON_TREE) {
//            throw new \RuntimeException(Yii::t('app', 'Яблоко еще на дереве!'));
            Yii::$app->session->setFlash('danger', Yii::t('app', 'Яблоко еще на дереве!'));
            return $this->redirect('index');
        }
        if ($this->_service->eat($model->id) == false) {
            Yii::$app->session->setFlash('danger', Yii::t('app', 'Яблоко съедено!'));
            return $this->redirect('index');
        }

        $applesArray = $this->_service->findAll();
        return $this->render('index', [
            'apples' => $applesArray,
        ]);
    }

}
