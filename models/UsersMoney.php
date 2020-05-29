<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users_money".
 *
 * @property int $id
 * @property int $money_id
 * @property int $user_id
 * @property float $value
 * @property int|null $isAcceptad
 * @property string $dt
 * @property string $dt_Accepted
 *
 * @property Exchange[] $exchanges
 * @property Money $money
 * @property Users $user
 */
class UsersMoney extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users_money';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['money_id', 'user_id', 'value'], 'required'],
            [['money_id', 'user_id', 'isAcceptad'], 'integer'],
            [['value'], 'number'],
            [['dt', 'dt_Accepted'], 'safe'],
            [['money_id'], 'exist', 'skipOnError' => true, 'targetClass' => Money::className(), 'targetAttribute' => ['money_id' => 'id']],
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
            'money_id' => 'Money ID',
            'user_id' => 'User ID',
            'value' => 'Value',
            'isAcceptad' => 'Is Acceptad',
            'dt' => 'Dt',
            'dt_Accepted' => 'Dt Accepted',
        ];
    }

    /**
     * Gets query for [[Exchanges]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExchanges()
    {
        return $this->hasMany(Exchange::className(), ['user_money_id' => 'id']);
    }

    /**
     * Gets query for [[Money]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMoney()
    {
        return $this->hasOne(Money::className(), ['id' => 'money_id']);
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
