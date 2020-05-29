<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LoyalityPoints */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="loyality-points-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'min_value')->textInput() ?>

    <?= $form->field($model, 'max_value')->textInput() ?>

    <?= $form->field($model, 'prize_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
