<?php

use yii\helpers\Url;
use yii\helpers\Html;

?>

<div class="col-sm-4 mb-3">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
            <p class="card-text">Some quick example.</p>
            <?= Html::a(Yii::t('app', 'Упасть'), Url::to(['/apples/apples/fall-down']), [
                'class' => 'card-link',
            ]) ?>
            <?= Html::a(Yii::t('app', 'Съесть'), Url::to(['/apples/apples/eat']), [
                'class' => 'card-link',
            ]) ?>
        </div>
    </div>
</div>

