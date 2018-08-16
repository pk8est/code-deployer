<?php

namespace deployer\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Depository;

/**
 * DepositorySearch represents the model behind the search form of `common\models\Depository`.
 */
class DepositorySearch extends Depository
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'created_at', 'deleted_at', 'order'], 'integer'],
            [['type', 'address', 'account', 'password', 'private_key', 'public_key', 'updated_at', 'remark'], 'safe'],
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
        $query = Depository::find();

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
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->deleted_at,
            'order' => $this->order,
        ]);

        $query->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'account', $this->account])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'private_key', $this->private_key])
            ->andFilterWhere(['like', 'public_key', $this->public_key])
            ->andFilterWhere(['like', 'remark', $this->remark]);

        return $dataProvider;
    }
}
