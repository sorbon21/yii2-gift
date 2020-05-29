<?php

namespace app\controllers;

use app\models\Exchange;
use app\models\Goods;
use app\models\Items;
use app\models\LoyalityPoints;
use app\models\Money;
use app\models\Prizes;
use app\models\Stocks;
use app\models\UserItems;
use app\models\UsersLoyalityPoint;
use app\models\UsersMoney;
use yii\filters\AccessControl;
use yii\helpers\Json;

class ProfileController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' =>  ['exchange', 'balance','index','get-prize'],
                        'roles' => ['@'],
                    ]
                ],
            ],
        ];
    }
    public function actionBalance()
    {
        $user=\Yii::$app->user->id;
        $userMoney=UsersMoney::find()->join('LEFT JOIN', 'money', ' users_money.money_id = money.id')->where(['user_id'=>$user])->all();
        $userLoyalityPoint=UsersLoyalityPoint::find()->join('LEFT JOIN', 'loyality_points', ' users_loyality_point.loyality_point_id = loyality_points.id')->where(['user_id'=>$user])->all();
        $userItems=UserItems::find()->select('*')->join('left join','items','item_id=items.id')->where(['user_id'=>$user])->all();


        return $this->render('balance',['userMoney'=>$userMoney,'userLoyalityPoint'=>$userLoyalityPoint,'userItems'=>$userItems]);
    }

    public function actionExchange($id)
    {
        $user=\Yii::$app->user->id;
        $userMoney=UsersMoney::findOne($id);
        $userLoyality=new UsersLoyalityPoint();
        $userLoyality->user_id=$user;
        $userLoyality->value=$userMoney->value*$userMoney->money->coefficient;
        $userLoyality->loyality_point_id=LoyalityPoints::find()->one()->id;
        if ($userLoyality->save(false)){
            $exchange=new Exchange();
            $exchange->user_money_id=$userMoney->id;
            $exchange->user_loyality_point_id=$userLoyality->id;
            if ($exchange->save()){
                return $this->redirect(['profile/balance']);
            }
        }






    }
    public  function actionGetPrize($id)
    {
        $prizes=Prizes::find()->where(['stock_id'=>$id])->orderBy('rand()')->one();
        $result=[];
        $user=\Yii::$app->user->id;
        switch ($prizes->target_table)
        {
            case 'money':
                $gift=Money::findOne(['prize_id'=>$prizes->id]);
                if ($gift->summ>0){
                    $userMoney=new UsersMoney();
                    $userMoney->money_id=$gift->id;
                    $userMoney->user_id=$user;
                    $userMoney->value=rand($gift->min_value,$gift->max_value);
                    $gift->summ-=$userMoney->value;
                    if ($userMoney->save()&&$gift->save()){
                        $result[]=['msg'=>"Вы выиграли {$userMoney->value} Руб."];
                    }
                }else{
                    $result[]=['msg'=>"Вам не досталось нечего, попробуйте в следующий раз."];
                }

                break;
            case 'loyality_points':
                $gift=LoyalityPoints::findOne(['prize_id'=>$prizes->id]);
                $userLoayalityPoints=new UsersLoyalityPoint();
                $userLoayalityPoints->loyality_point_id=$gift->id;
                $userLoayalityPoints->user_id=$user;
                $userLoayalityPoints->value=rand($gift->min_value,$gift->max_value);
                if ($userLoayalityPoints->save()){
                    $result[]=['msg'=>"Вы выиграли {$userLoayalityPoints->value} Баллов."];
                }
                break;
            case 'items':
                $gift=Items::find()->where(['prize_id'=>$prizes->id])->orderBy('rand()')->one();
                $good=Goods::findOne($gift->good_id);
                if ($good->count>0)
                {
                    $userItems=new UserItems();
                    $userItems->user_id=$user;
                    $userItems->item_id=$gift->id;
                    $userItems->save();
                    $good->count-=1;
                    $good->save();
                    $result[]=['msg'=>"Выигано {$good->name} ценой {$good->price} Руб"];
                }else{
                    $result[]=['msg'=>"Нечего не выиграно"];
                }
                break;
        }
        return Json::encode($result);

    }

    public function actionIndex()
    {
        $stock=Stocks::find()->where(['isActive'=>true])->one();
        return $this->render('index',['stock'=>$stock]);
    }

}
