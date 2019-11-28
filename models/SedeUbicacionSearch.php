<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SedeUbicacion;

/**
 * SedeUbicacionSearch represents the model behind the search form of `app\models\SedeUbicacion`.
 */
class SedeUbicacionSearch extends SedeUbicacion
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ubicacion_codigo', 'sede_codigo', 'aforo', 'activo'], 'integer'],
            [['nombre', 'direccion'], 'safe'],
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
        $query = SedeUbicacion::find();

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
            'ubicacion_codigo' => $this->ubicacion_codigo,
            'sede_codigo' => $this->sede_codigo,
            'aforo' => $this->aforo,
            'activo' => $this->activo,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'direccion', $this->direccion]);

        return $dataProvider;
    }
}
