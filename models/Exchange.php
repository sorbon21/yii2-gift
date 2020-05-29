<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "exchange".
 *
 * @property int $id
 * @property int|null $user_money_id
 * @property int|null $user_loyality_point_id
 * @property string $dt
 *
 * @property UsersMoney $userMoney
 * @property UsersLoyalityPoint $userLoyalityPoint
 */
class Exchange extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'exchange';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_money_id', 'user_loyality_point_id'], 'integer'],
            [['dt'], 'safe'],
            [['user_money_id'], 'exist', 'skipOnError' => true, 'targetClass' => UsersMoney::className(), 'targetAttribute' => ['user_money_id' => 'id']],
            [['user_loyality_point_id'], 'exist', 'skipOnError' => true, 'targetClass' => UsersLoyalityPoint::className(), 'targetAttribute' => ['user_loyality_point_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_money_id' => 'User Money ID',
            'user_loyality_point_id' => 'User Loyality Point ID',
            'dt' => 'Dt',
        ];
    }

    /**
     * Gets query for [[UserMoney]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserMoney()
    {
        return $this->hasOne(UsersMoney::className(), ['id' => 'user_money_id']);
    }

    /**
     * Gets query for [[UserLoyalityPoint]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserLoyalityPoint()
    {
        return $this->hasOne(UsersLoyalityPoint::className(), ['id' => 'user_loyality_point_id']);
    }
}
