<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Eventos;

/**
 * EventosSearch represents the model behind the search form of `app\models\Eventos`.
 */
class EventosSearch extends Eventos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['evento_codigo', 'organizacion_codigo', 'Estado_codigo', 'usuario_registro', 'usuario_modificacion'], 'integer'],
            [['nombre', 'fecha_modificacion', 'fecha_registro'], 'safe'],
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
        $query = Eventos::find();

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
            'evento_codigo' => $this->evento_codigo,
            'organizacion_codigo' => $this->organizacion_codigo,
            'Estado_codigo' => $this->Estado_codigo,
            'usuario_registro' => $this->usuario_registro,
            'usuario_modificacion' => $this->usuario_modificacion,
            'fecha_modificacion' => $this->fecha_modificacion,
            'fecha_registro' => $this->fecha_registro,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre]);

        return $dataProvider;
    }
}
