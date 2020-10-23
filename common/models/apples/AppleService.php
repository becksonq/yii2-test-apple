<?php


namespace common\models\apples;


class AppleService
{
    /** @var Apples $_apples */
    private $_apples;

    /** @var AppleRepository $_repository */
    private $_repository;

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

    public function findAll()
    {
        return $this->_repository->findAll();
    }

    public function deleteAll()
    {
        $this->_repository->deleteAll();
    }

    public function findOne(int $id)
    {
        return $this->_repository->findOne($id);
    }

    public function createApples(int $count): array
    {
        $apples = [];
        for ($i = 0; $i < $count; $i++) {
            $apples[] = self::create();
        }

        return $apples;
    }

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
            $model->eat_percent = 0;
            $this->_repository->delete($model);
            return false;
        } else {
            $model->eat_percent = $model->eat_percent - Apples::EAT_PERCENT;
        }

        return $this->_repository->update($model);
    }
}