<?php

/*
 * This file is part of the Dektrium project.
 *
 * (c) Dektrium project <http://github.com/dektrium>
 *
 * For the full copyright and license information, please view the LICENSE.md
 * file that was distributed with this source code.
 */

use dektrium\user\widgets\Connect;
use dektrium\user\models\LoginForm;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\themes\apples\assets\AppAsset;

AppAsset::register($this);

/**
 * @var yii\web\View $this
 * @var dektrium\user\models\LoginForm $model
 * @var dektrium\user\Module $module
 */

$this->title = Yii::t('user', 'Sign in');
$this->params['breadcrumbs'][] = $this->title;
?>

<?= $this->render('/_alert', ['module' => Yii::$app->getModule('user')]) ?>

<?php $form = ActiveForm::begin([
    'id'                     => 'login-form',
    'enableAjaxValidation'   => true,
    'enableClientValidation' => false,
    'validateOnBlur'         => false,
    'validateOnType'         => false,
    'validateOnChange'       => false,
    'options'                => [
        'style' => 'width: 100%; max-width: 330px; padding: 15px; margin: auto;',
    ]
]) ?>

    <h1 class="h3 mb-3 font-weight-normal"><?= Html::encode($this->title) ?></h1>
<?php if ($module->debug): ?>
    <?= $form->field($model, 'login', [
        'inputOptions' => [
            'autofocus' => 'autofocus',
            'class'     => 'form-control',
            'tabindex'  => '1'
        ]
    ])->dropDownList(LoginForm::loginList());
    ?>

<?php else: ?>
    
    <?= $form->field($model, 'login',
        ['inputOptions' => ['autofocus' => 'autofocus', 'class' => 'form-control', 'tabindex' => '1', 'placeholder' => 'Login']]
    )->label(false);
    ?>

<?php endif ?>

<?php if ($module->debug): ?>
    <div class="alert alert-warning">
        <?= Yii::t('user', 'Password is not necessary because the module is in DEBUG mode.'); ?>
    </div>
<?php else: ?>
    <?= $form->field(
        $model,
        'password',
        ['inputOptions' => ['class' => 'form-control', 'tabindex' => '2', 'placeholder' => 'Password']])
        ->passwordInput()->label(false)
    ?>
<?php endif ?>

<?= $form->field($model, 'rememberMe')->checkbox(['tabindex' => '3']) ?>

<?= Html::submitButton(
    Yii::t('user', 'Sign in'),
    ['class' => 'btn btn-primary btn-block', 'tabindex' => '4']
) ?>

<?= Connect::widget([
    'baseAuthUrl' => ['/user/security/auth'],
]) ?>

<?php ActiveForm::end(); ?>