<?php

namespace common\models\apples;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%apples}}".
 *
 * @property int $id
 * @property string $apple_color
 * @property int $date_create
 * @property int|null $date_fall
 * @property int $status
 * @property float|null $eat_percent
 * @property int $created_at
 * @property int $updated_at
 */
class Apples extends ActiveRecord
{
    /**  */
    const ON_TREE = 1;
    const ON_EARTH = 0;
    const ROTTEN_APPLE = 'rotten_apple';

    /** Цвет новых яблок */
    const APPLE_COLOR = ['green', 'red', 'violet'];

    public $onTree;

    public $onEarth;

    public $rottenApple;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%apples}}';
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class'      => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['apple_color', 'date_create',], 'required'],
            [['date_create', 'date_fall', 'status', 'created_at', 'updated_at'], 'integer'],
            [['eat_percent'], 'number'],
            [['apple_color'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'          => Yii::t('app', 'ID'),
            'apple_color' => Yii::t('app', 'Apple Color'),
            'date_create' => Yii::t('app', 'Date Create'),
            'date_fall'   => Yii::t('app', 'Date Fall'),
            'status'      => Yii::t('app', 'Status'),
            'eat_percent' => Yii::t('app', 'Eat Percent'),
            'created_at'  => Yii::t('app', 'Created At'),
            'updated_at'  => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @param string $color
     * @param int $date_create
     * @return static
     */
    public static function create(string $color, int $date_create): self
    {
        $apple = new static();
        $apple->apple_color = $color;
        $apple->date_create = $date_create;

        return $apple;
    }
}
