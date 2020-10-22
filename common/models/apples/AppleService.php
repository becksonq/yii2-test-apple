<?php


namespace common\models\apples;


class AppleService
{
    private $_apples;
    private $_repository;

    public function __construct(Apples $apples, AppleRepository $repository)
    {
        $this->_apples = $apples;
        $this->_repository = $repository;
    }

    public function create(): Apples
    {
        $apple = $this->_apples::create(
            array_rand(Apples::APPLE_COLOR),
            rand(strtotime("-1 week"), time())
        );
        $this->_repository->save($apple);
        return $apple;
    }

    public function deleteAll()
    {
        $this->_repository->deleteAll();
    }

    public function createApples(int $count): array
    {
        $apples = [];
        for ($i = 0; $i < $count; $i++) {
            $apples[] = self::create();
        }

        return $apples;
    }
}