<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View
 * @var $apples array
 */
?>

<div class="col-sm-12 my-5">
    <?= Html::a(Yii::t('app', 'Создать яблоки'), Url::to(['apples/apples/create-apples']), [
        'class' => 'btn btn-success',
    ]) ?>
    <?= Html::a(Yii::t('app', 'Удалить яблоки'), Url::to(['apples/apples/delete-apples']), [
        'class' => 'btn btn-danger',
    ]) ?>
</div>

<?php
if (!empty($apples)) {
    foreach ($apples as $apple):
        echo $this->render('_card');
    endforeach;
}
?>

