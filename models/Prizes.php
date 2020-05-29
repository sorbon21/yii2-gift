<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "prizes".
 *
 * @property int $id
 * @property int $stock_id
 * @property string|null $name
 * @property string|null $target_table
 * @property int|null $isActive
 * @property string $dt
 *
 * @property Item[] $items
 * @property LoyalityPoint[] $loyalityPoints
 * @property Money[] $moneys
 * @property Stock $stock
 */
class Prizes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'prizes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['stock_id'], 'required'],
            [['stock_id', 'isActive'], 'integer'],
            [['target_table'], 'string'],
            [['dt'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
            [['stock_id'], 'exist', 'skipOnError' => true, 'targetClass' => Stocks::className(), 'targetAttribute' => ['stock_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'stock_id' => 'Stock ID',
            'name' => 'Name',
            'target_table' => 'Target Table',
            'isActive' => 'Is Active',
            'dt' => 'Dt',
        ];
    }

    /**
     * Gets query for [[Items]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(Items::className(), ['prize_id' => 'id']);
    }

    /**
     * Gets query for [[LoyalityPoints]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLoyalityPoints()
    {
        return $this->hasMany(LoyalityPoints::className(), ['prize_id' => 'id']);
    }

    /**
     * Gets query for [[Moneys]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMoneys()
    {
        return $this->hasMany(Money::className(), ['prize_id' => 'id']);
    }

    /**
     * Gets query for [[Stock]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStock()
    {
        return $this->hasOne(Stocks::className(), ['id' => 'stock_id']);
    }
}
