<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cd_project_action_server_group".
 *
 * @property string $id
 * @property int $project_action_id
 * @property int $server_group_id
 * @property int $status
 * @property int $order
 */
class ProjectActionServerGroup extends \common\models\CommonModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cd_project_action_server_group';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project_action_id', 'server_group_id', 'status', 'order'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'project_action_id' => Yii::t('app', 'Project Action ID'),
            'server_group_id' => Yii::t('app', 'Server Group ID'),
            'status' => Yii::t('app', 'Status'),
            'order' => Yii::t('app', 'Order'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return ProjectActionServerGroupQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjectActionServerGroupQuery(get_called_class());
    }

	public function getServers(){

	}
}
