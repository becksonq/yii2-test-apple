<?php


namespace common\models\apples;


use yii\web\NotFoundHttpException;

class AppleRepository
{
    /**
     * @param Apples $apple
     */
    public function save(Apples $apple): void
    {
        if (!$apple->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    /**
     * @param int $id
     * @return array|\yii\db\ActiveRecord|null
     */
    public function findOne(int $id)
    {
        if (!$model = Apples::find()->where(['id' => $id])->one()) {
            throw new \RuntimeException('Model not found.');
        }
        return $model;
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public function findAll()
    {
        return Apples::find()->all();
    }

    /**
     * @param Apples $apple
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function delete(Apples $apple): void
    {
        if (!$apple->delete()) {
            throw new \RuntimeException('Delete error.');
        }
    }

    /**
     * Удаляем все яблоки
     */
    public function deleteAll(): void
    {
        if (!Apples::deleteAll()) {
            throw new \RuntimeException('Delete all error.');
        }
    }

    /**
     * @param $model Apples
     * @return mixed
     */
    public function update(Apples $model)
    {
        return $model->update();
    }
}