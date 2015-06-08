<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ContestType;

/**
 * ContestTypeSearch represents the model behind the search form about `common\models\ContestType`.
 */
class ContestTypeSearch extends ContestType
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'min_players', 'max_players', 'structure_id', 'status'], 'integer'],
            [['title'], 'safe'],
            [['entry_fee', 'withheld'], 'number'],
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
        $query = ContestType::find();

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
            'entry_fee' => $this->entry_fee,
            'withheld' => $this->withheld,
            'min_players' => $this->min_players,
            'max_players' => $this->max_players,
            'structure_id' => $this->structure_id,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}
