<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\LoyalityPoints;

/**
 * LoyalityPointsSearch represents the model behind the search form of `app\models\LoyalityPoints`.
 */
class LoyalityPointsSearch extends LoyalityPoints
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'prize_id'], 'integer'],
            [['min_value', 'max_value'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = LoyalityPoints::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'min_value' => $this->min_value,
            'max_value' => $this->max_value,
            'prize_id' => $this->prize_id,
        ]);

        return $dataProvider;
    }
}
