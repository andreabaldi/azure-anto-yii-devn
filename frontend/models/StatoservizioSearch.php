<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Statoservizio;

/**
 * StatoservizioSearch represents the model behind the search form of `frontend\models\Statoservizio`.
 */
class StatoservizioSearch extends Statoservizio
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['stato', 'sospesoDa', 'sospesoAl', 'info'], 'safe'],
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
        $query = Statoservizio::find();

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
            'sospesoDa' => $this->sospesoDa,
            'sospesoAl' => $this->sospesoAl,
        ]);

        $query->andFilterWhere(['like', 'stato', $this->stato])
            ->andFilterWhere(['like', 'info', $this->info]);

        return $dataProvider;
    }
}
