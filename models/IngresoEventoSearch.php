<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\IngresoEvento;

/**
 * IngresoEventoSearch represents the model behind the search form of `app\models\IngresoEvento`.
 */
class IngresoEventoSearch extends IngresoEvento
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ingreso_codigo', 'invitado_codigo', 'programacion_codigo', 'evento_codigo', 'sede_codigo'], 'integer'],
            [['fecha_ingreso', 'Ip'], 'safe'],
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
        $query = IngresoEvento::find();

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
            'ingreso_codigo' => $this->ingreso_codigo,
            'invitado_codigo' => $this->invitado_codigo,
            'programacion_codigo' => $this->programacion_codigo,
            'evento_codigo' => $this->evento_codigo,
            'sede_codigo' => $this->sede_codigo,
            'fecha_ingreso' => $this->fecha_ingreso,
        ]);

        $query->andFilterWhere(['like', 'Ip', $this->Ip]);

        return $dataProvider;
    }
}
