<?php


namespace common\models\apples;

/**
 * Class AppleHelper
 * @package common\models\apples
 */
class AppleHelper
{
    /**
     * @return string[]
     */
    public static function colors()
    {
        return [
            'green'  => 'Зеленое',
            'red'    => 'Красное',
            'violet' => 'Фиолетовое',
            'dark'   => 'Черное',
        ];
    }

    /**
     * @param string $color
     * @return string
     */
    public static function getAppleColor(string $color): string
    {
        $colorsArray = self::colors();
        return $colorsArray[$color];
    }

    /**
     * @return string[]
     */
    public static function status()
    {
        return [
            Apples::ON_TREE      => 'Еще на дереве',
            Apples::ON_EARTH     => 'Уже на земле',
            Apples::ROTTEN_APPLE => 'Уже все :(',
        ];
    }

    /**
     * @param int $status
     * @return string
     */
    public static function getStatus(int $status): string
    {
        $statusArray = self::status();
        return $statusArray[$status];
    }

    /**
     * @return string[]
     */
    public static function cardStyles()
    {
        return [
            'green'  => '-success',
            'red'    => '-danger',
            'violet' => '-primary',
            'dark'   => '-dark',
        ];
    }

    /**
     * @param string $color
     * @return string
     */
    public static function getCardStyle(string $color): string
    {
        $stylesArray = self::cardStyles();
        return $stylesArray[$color];
    }

    /**
     * @param int $status
     * @return string
     */
    public static function eatBtnVisible(int $status): string
    {
        switch ($status) {
            case Apples::ON_EARTH:
                $class = 'card-link';
                break;
            case Apples::ON_TREE:
                $class = 'd-none';
                break;
        }
        return $class;
    }

    /**
     * @param int $status
     * @return string
     */
    public static function fallBtnVisible(int $status): string
    {
        switch ($status) {
            case Apples::ON_EARTH:
                $class = 'd-none';
                break;
            case Apples::ON_TREE:
                $class = 'card-link';
                break;
        }
        return $class;
    }

    /**
     * @param Apples $model
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    public static function state(Apples $model): string
    {
        if ($model->isOnTree()) {
            $string = 'Появилось ' . \Yii::$app->formatter->asDatetime($model->date_create, "php:d.m.Y H:i");
        }
        if ($model->isOnEarth()) {
            $string = 'Упало ' . \Yii::$app->formatter->asDatetime($model->date_fall, "php:d.m.Y H:i");
        }
        if ($model->isRotten()) {
            $string = 'Яблоко гнилое';
        }
        return $string;
    }

    /**
     * @param float $eat_percent
     * @return string
     */
    public static function getEatPercent(float $eat_percent): string
    {
        $eat_percent == 1
            ? $string = 'Яблоко целое'
            : $string = 'Осталось ' . $eat_percent . '%';

        return $string;
    }
}