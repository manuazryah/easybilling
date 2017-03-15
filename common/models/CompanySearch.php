<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Company;

/**
 * CompanySearch represents the model behind the search form about `common\models\Company`.
 */
class CompanySearch extends Company
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'city', 'state', 'country', 'status', 'CB', 'UB'], 'integer'],
            [['name', 'formation_date', 'currency', 'tin', 'cst', 'gst', 'pan', 'cin', 'address1', 'address2', 'postal_code', 'phone', 'mobile', 'email', 'web', 'logo', 'note', 'DOC', 'DOU'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Company::find();

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
            'city' => $this->city,
            'state' => $this->state,
            'country' => $this->country,
            'status' => $this->status,
            'CB' => $this->CB,
            'UB' => $this->UB,
            'DOC' => $this->DOC,
            'DOU' => $this->DOU,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'formation_date', $this->formation_date])
            ->andFilterWhere(['like', 'currency', $this->currency])
            ->andFilterWhere(['like', 'tin', $this->tin])
            ->andFilterWhere(['like', 'cst', $this->cst])
            ->andFilterWhere(['like', 'gst', $this->gst])
            ->andFilterWhere(['like', 'pan', $this->pan])
            ->andFilterWhere(['like', 'cin', $this->cin])
            ->andFilterWhere(['like', 'address1', $this->address1])
            ->andFilterWhere(['like', 'address2', $this->address2])
            ->andFilterWhere(['like', 'postal_code', $this->postal_code])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'mobile', $this->mobile])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'web', $this->web])
            ->andFilterWhere(['like', 'logo', $this->logo])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
