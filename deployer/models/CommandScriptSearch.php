<?php

namespace deployer\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CommandScript;

/**
 * CommandScriptSearch represents the model behind the search form of `common\models\CommandScript`.
 */
class CommandScriptSearch extends CommandScript
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'creater_id', 'status', 'created_at', 'deleted_at', 'order'], 'integer'],
            [['name', 'script', 'runner', 'type', 'is_local', 'updated_at', 'remark'], 'safe'],
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
        $query = CommandScript::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
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
            'creater_id' => $this->creater_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
            'order' => $this->order,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'script', $this->script])
            ->andFilterWhere(['like', 'runner', $this->runner])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'is_local', $this->is_local])
            ->andFilterWhere(['like', 'remark', $this->remark]);

        return $dataProvider;
    }
}
