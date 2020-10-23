<?php


namespace common\models\apples;

/**
 * Class AppleService
 * @package common\models\apples
 */
class AppleService
{
    private $_apples;
    private $_repository;

    /**
     * AppleService constructor.
     * @param Apples $apples
     * @param AppleRepository $repository
     */
    public function __construct(Apples $apples, AppleRepository $repository)
    {
        $this->_apples = $apples;
        $this->_repository = $repository;
    }

    /**
     * Создаем яблоко
     * @return Apples
     */
    public function create(): Apples
    {
        $rand = array_rand(Apples::APPLE_COLOR);
        $apple = $this->_apples::create(
            Apples::APPLE_COLOR[$rand],
            rand(strtotime("-1 week"), time())
        );
        $this->_repository->save($apple);
        return $apple;
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public function findAll()
    {
        return $this->_repository->findAll();
    }

    /**
     * Удаляем все яблоки
     */
    public function deleteAll()
    {
        $this->_repository->deleteAll();
    }

    /**
     * @param int $id
     * @return array|\yii\db\ActiveRecord|null
     */
    public function findOne(int $id)
    {
        return $this->_repository->findOne($id);
    }

    /**
     * @param int $count
     * @return array
     */
    public function createApples(int $count): array
    {
        $apples = [];
        for ($i = 0; $i < $count; $i++) {
            $apples[] = self::create();
        }

        return $apples;
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function changeStatus(int $id)
    {
        /** @var Apples $model */
        $model = $this->findOne($id);
        $model->status = Apples::ON_EARTH;
        $model->date_fall = time();

        return $this->_repository->update($model);
    }

    /**
     * @param int $id
     * @return false|mixed
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function eat(int $id)
    {
        /** @var Apples $model */
        $model = $this->_repository->findOne($id);
        if ($model->eat_percent <= Apples::EAT_PERCENT) {
            $this->_repository->delete($model);
            return false;
        } else {
            $model->eat_percent = $model->eat_percent - Apples::EAT_PERCENT;
        }

        return $this->_repository->update($model);
    }

    /**
     * @param array $models
     */
    public function checkStatus(array $models)
    {
        foreach ($models as $model) {
            $lifetime = (time() - $model->date_fall) > Apples::LIFETIME;
            /** @var Apples $model */
            if ($model->date_fall !== null && $lifetime) {
                $model->apple_color = 'dark';
                $model->status = Apples::ROTTEN_APPLE;
                $this->_repository->update($model);
            }
        }
    }
}