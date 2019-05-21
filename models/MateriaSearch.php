<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Materia;
use app\models\Correlativa;
use app\models\HorarioCursado;

/**
 * MateriaSearch represents the model behind the search form of `app\models\Materia`.
 */
class MateriaSearch extends Materia
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_carrera', 'anio_cursada'], 'integer'],
            [['nombre', 'periodo'], 'safe'],
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
    public function search($params, $id_carrera=null)
    {
        if ($id_carrera!=null){
            $query = Materia::find()->where(['id_carrera' => $id_carrera]);;
        }else{
            $query = Materia::find();
        }
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ]
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
            'id_carrera' => $this->id_carrera,
            'anio_cursada' => $this->anio_cursada,
        ]);

        $query->andFilterWhere(['like', 'nombre', $this->nombre])
            ->andFilterWhere(['like', 'periodo', $this->periodo]);

        return $dataProvider;
    }
}
