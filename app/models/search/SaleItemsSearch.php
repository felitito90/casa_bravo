<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SaleItems;

/**
 * SaleItemsSearch represents the model behind the search form of `app\models\SaleItems`.
 */
class SaleItemsSearch extends SaleItems
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'menu_item_id', 'customer_auth_id', 'sale_id', 'quantity'], 'integer'],
            [['created_at'], 'safe'],
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
        $query = SaleItems::find();

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
            'menu_item_id' => $this->menu_item_id,
            'customer_auth_id' => $this->customer_auth_id,
            'sale_id' => $this->sale_id,
            'quantity' => $this->quantity,
            'created_at' => $this->created_at,
        ]);

        return $dataProvider;
    }
}
