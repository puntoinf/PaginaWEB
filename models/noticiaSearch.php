<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Noticia;

/**
 * noticiaSearch represents the model behind the search form of `app\models\Noticia`.
 */
class noticiaSearch extends Noticia
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'importante'], 'integer'],
            [['titulo', 'texto', 'id_usuario', 'fecha', 'id_estado', 'copete', 'imagen'], 'safe'],
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
        $query = Noticia::find();
        $query->leftJoin('estado','estado.id=noticia.id_estado');
        $query->leftJoin('usuario','usuario.id=noticia.id_usuario');

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
            
            'fecha' => $this->fecha,
            'importante' => $this->importante,
        ]);

        $query->andFilterWhere(['like', 'titulo', $this->titulo])
            ->andFilterWhere(['like', 'texto', $this->texto])
            ->andFilterWhere(['like', 'copete', $this->copete])
            ->andFilterWhere(['like', 'imagen', $this->imagen])
            ->andFilterWhere(['like', 'estado.descripcion', $this->id_estado])
            ->andFilterWhere(['like', 'usuario.nombre', $this->id_usuario]);

        return $dataProvider;
    }
}
