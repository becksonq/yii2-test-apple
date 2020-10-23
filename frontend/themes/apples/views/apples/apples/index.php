<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View
 * @var $apples array
 */
?>

<div class="col-sm-12 my-5">
    <?= Html::beginTag('div', ['class' => 'btn-group', 'role' => 'group', 'aria-label' => 'Basic example']) ?>
    <?= Html::a(Yii::t('app', 'Создать яблоки'), Url::to(['apples/apples/create-apples']), [
        'class' => 'btn btn-success',
    ]) ?>
    <?= Html::a(Yii::t('app', 'Удалить яблоки'), Url::to(['apples/apples/delete-apples']), [
        'class' => 'btn btn-danger',
    ]) ?>
    <?= Html::endTag('div') ?>
</div>

<?php
if (!empty($apples)) {
    foreach ($apples as $apple):
        echo $this->render('_card', [
            'model' => $apple,
        ]);
    endforeach;
}
?>

