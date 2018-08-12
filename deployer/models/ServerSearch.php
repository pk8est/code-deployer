<?php

namespace deployer\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Server;

/**
 * ServerSearch represents the model behind the search form of `common\models\Server`.
 */
class ServerSearch extends Server
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'room_id', 'creater_id', 'status', 'created_at', 'deleted_at', 'order'], 'integer'],
            [['name', 'desc', 'ip', 'inner_ip', 'ssh_private_key', 'type', 'level', 'updated_at', 'remark'], 'safe'],
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
        $query = Server::find();

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
            'room_id' => $this->room_id,
            'creater_id' => $this->creater_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
            'order' => $this->order,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'desc', $this->desc])
            ->andFilterWhere(['like', 'ip', $this->ip])
            ->andFilterWhere(['like', 'inner_ip', $this->inner_ip])
            ->andFilterWhere(['like', 'ssh_private_key', $this->ssh_private_key])
            ->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'level', $this->level])
            ->andFilterWhere(['like', 'remark', $this->remark]);

        return $dataProvider;
    }
}
