<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use phpDocumentor\Reflection\Types\Integer;
use yii\console\Controller;
use yii\console\ExitCode;

use app\models\Prizes;
use app\models\Users;
use app\models\Goods;
use app\models\Items;
use app\models\LoyalityPoints;
use app\models\UsersLoyalityPoint;
use app\models\Money;
use app\models\Stocks;
use app\models\UserItems;
use app\models\UsersMoney;


/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class PayController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $N the message to be echoed.
     * @return int Exit code
     */
    public function actionIndex()
    {


            $usersMoney=UsersMoney::find()->all();
            foreach ($usersMoney as $mItem){
                $mItem->isAcceptad=1;
                $mItem->dt_Accepted=date('Y-m-d H:i:s');
                $mItem->save();
            }
        $usersLoyality=UsersLoyalityPoint::find()->all();
        foreach ($usersLoyality as $mItem){
            $mItem->isAcceptad=1;
            $mItem->dt_Accepted=date('Y-m-d H:i:s');
            $mItem->save();
        }


        return ExitCode::OK;
    }
}
