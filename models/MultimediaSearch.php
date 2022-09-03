<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Multimedia;

/**
 * MultimediaSearch represents the model behind the search form of `app\models\Multimedia`.
 */
class MultimediaSearch extends Multimedia
{
    /**
     * {@inheritdoc}
     */
    public $des;
    public function rules()
    {
        return [
            [['id', 'tipo', 'contenido_id'], 'integer'],
            [['nombre', 'descripcion', 'url','des'], 'safe'],
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
        $query = Multimedia::find()
        ->joinWith(['destinos']);;

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
            'tipo' => $this->tipo,
            'contenido_id' => $this->contenido_id,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'descripcion', $this->descripcion])
            ->andFilterWhere(['like', 'url', $this->url])
            ->andFilterWhere(['like', 'destinos.nombre', $this->des]);

        return $dataProvider;
    }
}
