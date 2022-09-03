<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Turista;

/**
 * TuristaSearch represents the model behind the search form of `app\models\Turista`.
 */
class TuristaSearch extends Turista
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'sex', 'country_id'], 'integer'],
            [['name', 'lastname', 'city', 'age', 'places_of_interest', 'reason_of_visit', 'with_whom_travel', 'username', 'email', 'password', 'fecha_alta'], 'safe'],
            [['status'], 'boolean'],
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
        $query = Turista::find();

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
            'sex' => $this->sex,
            'country_id' => $this->country_id,
            'fecha_alta' => $this->fecha_alta,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'lastname', $this->lastname])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'age', $this->age])
            ->andFilterWhere(['like', 'places_of_interest', $this->places_of_interest])
            ->andFilterWhere(['like', 'reason_of_visit', $this->reason_of_visit])
            ->andFilterWhere(['like', 'with_whom_travel', $this->with_whom_travel])
            ->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'password', $this->password]);

        return $dataProvider;
    }
}
