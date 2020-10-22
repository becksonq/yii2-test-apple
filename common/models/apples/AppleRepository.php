<?php


namespace common\models\apples;


class AppleRepository
{
    public function save(Apples $apple): void
    {
        if (!$apple->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    public function deleteAll()
    {
        if (!Apples::deleteAll()) {
            throw new \RuntimeException('Delete all error.');
        }
    }
}