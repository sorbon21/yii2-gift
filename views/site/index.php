<?php

/* @var $this yii\web\View */

$this->title = 'Добро пожаловать';

?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Добро пожаловать!</h1>
        <p><a class="btn btn-lg btn-success" href="<?=\yii\helpers\Url::to(['site/login'])?>">Вход</a></p>
    </div>
</div>
