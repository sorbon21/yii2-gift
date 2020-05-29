<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Money */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="money-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'prize_id')->textInput() ?>

    <?= $form->field($model, 'min_value')->textInput() ?>

    <?= $form->field($model, 'max_value')->textInput() ?>

    <?= $form->field($model, 'summ')->textInput() ?>

    <?= $form->field($model, 'coefficient')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
