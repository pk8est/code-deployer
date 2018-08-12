<?php

namespace deployer\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Project;

/**
 * ProjectSearch represents the model behind the search form of `common\models\Project`.
 */
class ProjectSearch extends Project
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'creater_id', 'project_group_id', 'repo_type', 'status', 'published_at', 'created_at', 'deleted_at', 'order'], 'integer'],
            [['name', 'repo_address', 'repo_account', 'repo_password', 'repo_private_key', 'repo_branch', 'desc', 'type', 'updated_at', 'remark'], 'safe'],
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
        $query = Project::find();

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
            'project_group_id' => $this->project_group_id,
            'repo_type' => $this->repo_type,
            'status' => $this->status,
            'published_at' => $this->published_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
            'order' => $this->order,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'repo_address', $this->repo_address])
            ->andFilterWhere(['like', 'repo_account', $this->repo_account])
            ->andFilterWhere(['like', 'repo_password', $this->repo_password])
            ->andFilterWhere(['like', 'repo_private_key', $this->repo_private_key])
            ->andFilterWhere(['like', 'repo_branch', $this->repo_branch])
            ->andFilterWhere(['like', 'desc', $this->desc])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'remark', $this->remark]);

        return $dataProvider;
    }
}
