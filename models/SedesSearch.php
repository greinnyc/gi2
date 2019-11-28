<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Sedes;

/**
 * SedesSearch represents the model behind the search form of `app\models\Sedes`.
 */
class SedesSearch extends Sedes
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sede_codigo', 'organizacion_codigo', 'activo', 'usuario_registro', 'usuario_modificacion'], 'integer'],
            [['nombre', 'fecha_registro', 'fecha_modificacion'], 'safe'],
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
        $query = Sedes::find();

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
            'sede_codigo' => $this->sede_codigo,
            'organizacion_codigo' => $this->organizacion_codigo,
            'activo' => $this->activo,
            'usuario_registro' => $this->usuario_registro,
            'usuario_modificacion' => $this->usuario_modificacion,
            'fecha_registro' => $this->fecha_registro,
            'fecha_modificacion' => $this->fecha_modificacion,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre]);

        return $dataProvider;
    }
}
