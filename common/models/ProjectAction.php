<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cd_project_action".
 *
 * @property string $id
 * @property int $project_id
 * @property int $action_id
 * @property int $order
 */
class ProjectAction extends \common\models\CommonModel
{
	public $server_group_ids = [];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cd_project_action';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project_id', 'action_id', 'order'], 'integer'],
			[['server_group_ids'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'project_id' => Yii::t('app', 'Project ID'),
            'action_id' => Yii::t('app', 'Action ID'),
            'order' => Yii::t('app', 'Order'),
        ];
    }

	public function afterDelete(){
		ProjectActionServerGroup::deleteAll(['project_action_id' => $this->id]);
		parent::afterDelete();
	}

    /**
     * {@inheritdoc}
     * @return ProjectActionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjectActionQuery(get_called_class());
    }

	public function getCommandAction(){
		return $this->hasMany(CommandAction::className(), ['id' => 'action_id']);
	}

	public function getProjectActionServer(){
		return $this->hasMany(ProjectActionServer::className(), ['project_id' => 'project_id', 'action_id' => 'action_id']);
	}

	public function getServerGroups(){
		return $this->hasMany(ServerGroup::className(), ['id' => 'server_group_id'])->via('serverGroupMap');

	}

	public function getServerGroupMap(){
		return $this->hasMany(ProjectActionServerGroup::className(), ['project_action_id' => 'id']);
	}

	public function updateMany($array, $delete = false){
        $data = [];
        foreach($array as $key => $value){
            $data[] = ['project_action_id' => $this->id, 'server_group_id' => $value, 'order' => $key];
        }
        if($delete){
            ProjectActionServerGroup::deleteAll(['project_action_id' => $this->id]);
        }
        if(count($data) > 0){
           Yii::$app->db->createCommand()->batchInsert(ProjectActionServerGroup::tableName(), array_keys($data[0]), $data)->execute();
        }
    }

}
