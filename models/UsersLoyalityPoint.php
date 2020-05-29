<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users_loyality_point".
 *
 * @property int $id
 * @property int $loyality_point_id
 * @property int $user_id
 * @property float $value
 * @property string $dt
 * @property string $dt_Accepted
 * @property int|null $isAcceptad
 *
 * @property Exchange[] $exchanges
 * @property LoyalityPoints $loyalityPoint
 * @property Users $user
 */
class UsersLoyalityPoint extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users_loyality_point';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['loyality_point_id', 'user_id', 'value'], 'required'],
            [['loyality_point_id', 'user_id', 'isAcceptad'], 'integer'],
            [['value'], 'number'],
            [['dt', 'dt_Accepted'], 'safe'],
            [['loyality_point_id'], 'exist', 'skipOnError' => true, 'targetClass' => LoyalityPoints::className(), 'targetAttribute' => ['loyality_point_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'loyality_point_id' => 'Loyality Point ID',
            'user_id' => 'User ID',
            'value' => 'Value',
            'dt' => 'Dt',
            'dt_Accepted' => 'Dt Accepted',
            'isAcceptad' => 'Is Acceptad',
        ];
    }

    /**
     * Gets query for [[Exchanges]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExchanges()
    {
        return $this->hasMany(Exchange::className(), ['user_loyality_point_id' => 'id']);
    }

    /**
     * Gets query for [[LoyalityPoint]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLoyalityPoint()
    {
        return $this->hasOne(LoyalityPoints::className(), ['id' => 'loyality_point_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }
}
