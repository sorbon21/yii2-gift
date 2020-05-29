<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "money".
 *
 * @property int $id
 * @property int $prize_id
 * @property float|null $min_value
 * @property float|null $max_value
 * @property float $summ
 * @property float $coefficient
 *
 * @property Prize $prize
 * @property UsersMoney[] $usersMoneys
 */
class Money extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'money';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['prize_id', 'summ', 'coefficient'], 'required'],
            [['prize_id'], 'integer'],
            [['min_value', 'max_value', 'summ', 'coefficient'], 'number'],
            [['prize_id'], 'exist', 'skipOnError' => true, 'targetClass' => Prizes::className(), 'targetAttribute' => ['prize_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'prize_id' => 'Prize ID',
            'min_value' => 'Min Value',
            'max_value' => 'Max Value',
            'summ' => 'Summ',
            'coefficient' => 'Coefficient',
        ];
    }

    /**
     * Gets query for [[Prize]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPrize()
    {
        return $this->hasOne(Prizes::className(), ['id' => 'prize_id']);
    }

    /**
     * Gets query for [[UsersMoneys]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsersMoneys()
    {
        return $this->hasMany(UsersMoney::className(), ['money_id' => 'id']);
    }
}
