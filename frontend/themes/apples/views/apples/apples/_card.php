<?php

use yii\helpers\Url;
use yii\helpers\Html;
use common\models\apples\AppleHelper;

/** @var $model \common\models\apples\Apples */

?>

<div class="col-sm-4 mb-3">
    <div class="card border<?= AppleHelper::getCardStyle($model->apple_color) ?>">
        <div class="card-body">
            <h5 class="card-title text<?= AppleHelper::getCardStyle($model->apple_color) ?>">
                <?= AppleHelper::getAppleColor($model->apple_color) ?> яблоко</h5>
            <?= Html::tag('h6', AppleHelper::state($model), ['class' => 'card-subtitle mb-2 text-muted']) ?>
            <p class="card-text"><?= AppleHelper::getStatus($model->status) ?></p>
            <p class="card-text"><?= AppleHelper::getEatPercent($model->eat_percent) ?></p>
            <?= Html::a(Yii::t('app', 'Упасть'), Url::to(['/apples/apples/fall-down', 'id' => $model->id]), [
                'class' => 'card-link',
            ]) ?>
            <?= Html::a(Yii::t('app', 'Съесть'), Url::to(['/apples/apples/eat', 'id' => $model->id]), [
                'class' => 'card-link',
            ]) ?>
        </div>
    </div>
</div>

