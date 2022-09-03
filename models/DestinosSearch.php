<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Destinos;

/**
 * DestinosSearch represents the model behind the search form of `app\models\Destinos`.
 */
class DestinosSearch extends Destinos
{
    /**
     * {@inheritdoc}
     */
    public $propietario;/* para hacer un select en search de preferencia  */
    public $catego;
    public function rules()
    {
        return [
            [['id', 'aforo', 'categoria_id', 'empresa_id'], 'integer'],
            [[
                'nombre', 'descripcion_corta', 'descripcion_larga', 'hora_apertura', 'hora_cierre', 'informacion_adicional',
                'ubicacion', 'infraestructura', 'actividades', 'servicios', 'inclusion', 'fecha_alta', 'propietario'/* para hacer un select en search de preferencia  */
            ,'catego'], 'safe'],
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
        $query = Destinos::find()
            ->joinWith(['empresa'])
            ->joinWith(['categoria']);/* para hacer un select en search de preferencia  */

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
            'hora_apertura' => $this->hora_apertura,
            'hora_cierre' => $this->hora_cierre,
            'aforo' => $this->aforo,
            /* 'status' => $this->status, */
            'fecha_alta' => $this->fecha_alta,
            'categoria_id' => $this->categoria_id,
            'empresa_id' => $this->empresa_id,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'descripcion_corta', $this->descripcion_corta])
            ->andFilterWhere(['like', 'descripcion_larga', $this->descripcion_larga])
            ->andFilterWhere(['like', 'informacion_adicional', $this->informacion_adicional])
            ->andFilterWhere(['like', 'ubicacion', $this->ubicacion])
            ->andFilterWhere(['like', 'infraestructura', $this->infraestructura])
            ->andFilterWhere(['like', 'actividades', $this->actividades])
            ->andFilterWhere(['like', 'servicios', $this->servicios])
            ->andFilterWhere(['like', 'inclusion', $this->inclusion])
            ->andFilterWhere(['like', 'empresa.nombre', $this->propietario])/* para hacer un select en search de preferencia  */
            ->andFilterWhere(['like', 'categoria.nombre', $this->catego]);
        return $dataProvider;
    }
}
