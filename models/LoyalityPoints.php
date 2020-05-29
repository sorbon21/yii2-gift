<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "loyality_points".
 *
 * @property int $id
 * @property float $min_value
 * @property float $max_value
 * @property int $prize_id
 *
 * @property Prize $prize
 * @property UsersLoyalityPoint[] $usersLoyalityPoints
 */
class LoyalityPoints extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'loyality_points';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['min_value', 'max_value', 'prize_id'], 'required'],
            [['min_value', 'max_value'], 'number'],
            [['prize_id'], 'integer'],
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
            'min_value' => 'Min Value',
            'max_value' => 'Max Value',
            'prize_id' => 'Prize ID',
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
     * Gets query for [[UsersLoyalityPoints]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsersLoyalityPoints()
    {
        return $this->hasMany(UsersLoyalityPoint::className(), ['loyality_point_id' => 'id']);
    }
}
