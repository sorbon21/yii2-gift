<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Prizes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="prizes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'stock_id')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'target_table')->dropDownList([ 'items' => 'Items', 'money' => 'Money', 'loyality_points' => 'Loyality points', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'isActive')->textInput() ?>

    <?= $form->field($model, 'dt')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
