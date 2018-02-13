<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Proyectos;

/**
 * ProyectosSearch represents the model behind the search form about `backend\models\Proyectos`.
 */
class ProyectosSearch extends Proyectos
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['idProyecto'], 'integer'],
            [['NombreProyecto'], 'safe'],
            [['Activo'], 'boolean'],
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
        $query = Proyectos::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'idProyecto' => $this->idProyecto,
            'Activo' => $this->Activo,
        ]);

        $query->andFilterWhere(['like', 'NombreProyecto', $this->NombreProyecto]);

        return $dataProvider;
    }
}
