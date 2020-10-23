<?php

namespace frontend\controllers\apples;


use Yii;
use common\models\apples\Apples;
use common\models\apples\AppleService;
use yii\helpers\Url;

class ApplesController extends \yii\web\Controller
{
    private $_service;

    /**
     * ApplesController constructor.
     * @param $id
     * @param $module
     * @param AppleService $service
     * @param array $config
     */
    public function __construct($id, $module, AppleService $service, $config = [])
    {
        $this->_service = $service;
        parent::__construct($id, $module, $config);
    }

    public function actionIndex()
    {
        $applesArray = $this->_service->findAll();
        $this->_service->checkStatus($applesArray);

        return $this->render('index', [
            'apples' => $applesArray,
        ]);
    }

    /**
     * @return \yii\web\Response
     */
    public function actionCreateApples()
    {
        $this->_service->createApples(rand(3, 10));

        return $this->redirect(['apples/apples/index']);
    }

    /**
     * @return \yii\web\Response
     */
    public function actionDeleteApples()
    {
        $this->_service->deleteAll();

        return $this->redirect(['apples/apples/index']);
    }

    /**
     * @param int $id
     * @return \yii\web\Response
     */
    public function actionFallDown(int $id)
    {
        $model = $this->_service->findOne($id);
        $this->_service->changeStatus($model->id);

        return $this->redirect(['apples/apples/index']);
    }

    /**
     * @param int $id
     * @return \yii\web\Response
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionEat(int $id)
    {
        /** @var Apples $model */
        $model = $this->_service->findOne($id);
        if ($model->isOnTree()) {
            // @todo:
//            throw new \RuntimeException(Yii::t('app', 'Яблоко еще на дереве!'));
            Yii::$app->session->setFlash('danger', Yii::t('app', 'Яблоко еще на дереве!'));
            return $this->redirect(['apples/apples/index']);
        }
        if ($model->isRotten()) {
            Yii::$app->session->setFlash('danger', Yii::t('app', 'Яблоко гнилое!'));
            return $this->redirect(['apples/apples/index']);
        }
        if ($this->_service->eat($model->id) == false) {
            Yii::$app->session->setFlash('danger', Yii::t('app', 'Яблоко съедено!'));
            return $this->redirect(['apples/apples/index']);
        }

        return $this->redirect(['apples/apples/index']);
    }

}
