<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\FieldList;

/**
 * FieldListSearch represents the model behind the search form about `backend\models\FieldList`.
 */
class FieldListSearch extends FieldList
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'visibility', 'new', 'excluded'], 'integer'],
            [['field', 'description', 'inserted_at'], 'safe'],
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
        $query = FieldList::find();

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
            'id' => $this->id,
            'visibility' => $this->visibility,
            'new' => $this->new,
            'excluded' => $this->excluded,
            'inserted_at' => $this->inserted_at,
        ]);

        $query->andFilterWhere(['like', 'field', $this->field])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
