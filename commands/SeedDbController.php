<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use app\models\Prizes;
use phpDocumentor\Reflection\Types\Integer;
use yii\console\Controller;
use yii\console\ExitCode;
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
class SeedDbController extends Controller
{
    /**
     * This command echoes what you have entered as the message.
     * @param string $N the message to be echoed.
     * @return int Exit code
     */
    public function actionIndex()
    {
        UsersMoney::deleteAll();
        UsersLoyalityPoint::deleteAll();
        UserItems::deleteAll();
        LoyalityPoints::deleteAll();
        Money::deleteAll();
        Prizes::deleteAll();
        Stocks::deleteAll();
        Users::deleteAll();
        Goods::deleteAll();
        Items::deleteAll();
        $stock=new Stocks();
        for ($i=1;$i<1000;$i++){
            $user=new Users();
            $user->login="user$i";
            $user->fio="Пользователь $i";
            $user->password=sha1("123456");
            $user->phone="7".($i%5).($i%8).($i%9)."32"."23";
            $user->postcode=($i%6).($i%4).($i%9).($i%3).($i%2).($i%9);
            $user->save(false);
        }

        $stock->name='Выигрывай деньги приз или же балы лояльности до 6 июня!!';
        $stock->description="Выигрывай деньги приз или же балы лояльности до 6 июня!!";
        if ($stock->save()){
            $prizes=new Prizes();
            $prizes->name='Предметы';
            $prizes->target_table='items';
            $prizes->stock_id=$stock->id;
            if ($prizes->save())
            {
                for ($i=1;$i<=100;$i++){
                    $good=new Goods();
                    $good->name="Предмет $i";
                    $good->description= "Описания предмета $i";
                    $good->price=rand(100,1000);
                    $good->count=rand(2,50);
                    if ($good->save())
                    {
                        $item=new Items();
                        $item->good_id=$good->id;
                        $item->prize_id=$prizes->id;
                        $item->save(false);
                    }
                }

            }

            $prizes=new Prizes();
            $prizes->name='Деньги';
            $prizes->target_table='money';
            $prizes->stock_id=$stock->id;

            if ($prizes->save()){
                $money=new Money();
                $money->prize_id=$prizes->id;
                $money->coefficient=2;
                $money->min_value=1;
                $money->max_value=10;
                $money->summ=2000;
                $money->save();
            }
            $prizes=new Prizes();
            $prizes->name='Баллы лояльности';
            $prizes->target_table='loyality_points';
            $prizes->stock_id=$stock->id;
            if ($prizes->save()){
                $loyalPoinis=new LoyalityPoints();
                $loyalPoinis->prize_id=$prizes->id;
                $loyalPoinis->min_value=10;
                $loyalPoinis->max_value=20;
                $loyalPoinis->save();
            }
        }

        return ExitCode::OK;
    }
}
