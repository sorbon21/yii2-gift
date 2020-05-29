<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "stocks".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property int|null $isActive
 * @property string $dt
 *
 * @property Prizes[] $prizes
 */
class Stocks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stocks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['isActive'], 'integer'],
            [['dt'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'isActive' => 'Is Active',
            'dt' => 'Dt',
        ];
    }

    /**
     * Gets query for [[Prizes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPrizes()
    {
        return $this->hasMany(Prizes::className(), ['stock_id' => 'id']);
    }
}
