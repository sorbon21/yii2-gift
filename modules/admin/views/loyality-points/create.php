<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LoyalityPoints */

$this->title = 'Create Loyality Points';
$this->params['breadcrumbs'][] = ['label' => 'Loyality Points', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="loyality-points-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
