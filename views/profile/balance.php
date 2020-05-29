
<div class="container-fluid">


    <div class="row">
        <div class="col-6">
            <h2>Деньги</h2>
            <table class="table table-active table-bordered">
                <tr>
                    <th>#</th>
                    <th>Сумма</th>
                    <th>Дата</th>
                    <th>Статус</th>
                    <th>Обменять на баллы</th>
                </tr>
                <?php
                    $summ=0;
                    foreach ($userMoney as $item): ?>
                        <?php
                            $tmpExcnange=\app\models\Exchange::findOne(['user_money_id'=>$item->id]);

                        ?>
                    <tr class="<?=isset($tmpExcnange)? 'strike': '' ?> ">
                        <td>
                            <?=$item->id?>
                        </td>
                        <td>
                            <?=$item->value?> Руб.
                        </td>
                        <td>
                            <?=$item->dt?>
                        </td>
                        <td>
                            <?=$item->isAcceptad==0 ?'<span>Не перечислен на счет': 'Перечислен'?>
                        </td>
                        <td>
                            <a href="<?=\yii\helpers\Url::to(['profile/exchange','id'=>$item->id])?>">Обменять</a>
                        </td>
                    </tr>
                <?php
                    if ($item->isAcceptad&&!isset($tmpExcnange)){
                        $summ+=$item->value;
                    }
                    endforeach; ?>
                <tr>
                    <td >
                        <strong>Итого</strong>
                    </td>
                    <td colspan="3">
                        <strong><?=$summ?> Руб</strong>
                    </td>
                </tr>
            </table>
        </div>
        <div class="col-6">
            <h2>Баллы</h2>
            <table class="table table-active table-bordered">
                <tr>
                    <th>#</th>
                    <th>Сумма</th>
                    <th>Дата</th>
                </tr>
                <?php
                $summ=0;
                foreach ($userLoyalityPoint as $item): ?>

                    <tr>
                        <td>
                            <?=$item->id?>
                        </td>
                        <td>
                            <?=$item->value?> Балл.
                        </td>
                        <td>
                            <?=$item->dt?>
                        </td>
                    </tr>
                    <?php
                        $summ+=$item->value;

                endforeach; ?>
                <tr>
                    <td >
                        <strong>Итого</strong>
                    </td>
                    <td colspan="3">
                        <strong><?=$summ?> Баллов</strong>
                    </td>
                </tr>
            </table>
        </div>
    </div>
        <div class="row">
            <h2>Предметы выигранные <?=count($userItems)?></h2>

            </div>

        </div>


</div>
