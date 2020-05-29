<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LoyalityPoints */

$this->title = 'Update Loyality Points: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Loyality Points', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="loyality-points-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
