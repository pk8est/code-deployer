<?php

namespace common\models;

use Yii;
use common\models\CommandActionScript;
use common\models\CommandScript;
use common\models\Server;
use common\models\ProjectActionServer;

/**
 * This is the model class for table "cd_project_job".
 *
 * @property string $id
 * @property int $project_id
 * @property int $creater_id 发布人ID
 * @property string $name
 * @property int $action_id
 * @property string $action_name
 * @property int $status
 * @property string $type 类型
 * @property int $started_at
 * @property int $finished_at
 * @property int $created_at
 * @property string $updated_at
 * @property int $deleted_at
 * @property string $variable
 * @property string $desc
 * @property string $remark 备注
 */
class ProjectJob extends \common\models\CommonModel
{

	const JOB_RUN_WAIT = 0;
	const JOB_RUN_STARTED = 1;
	const JOB_RUN_FINISHED = 10;
	const JOB_RUN_FAILED = -9;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cd_project_job';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project_id', 'creater_id', 'action_id', 'status', 'started_at', 'finished_at', 'created_at', 'deleted_at'], 'integer'],
            [['updated_at'], 'safe'],
            [['variable', 'desc', 'remark'], 'string'],
            [['name', 'action_name'], 'string', 'max' => 255],
            [['type'], 'string', 'max' => 50],
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
            'creater_id' => Yii::t('app', 'Creater ID'),
            'name' => Yii::t('app', 'Name'),
            'action_id' => Yii::t('app', 'Action ID'),
            'action_name' => Yii::t('app', 'Action Name'),
            'status' => Yii::t('app', 'Status'),
            'type' => Yii::t('app', 'Type'),
            'started_at' => Yii::t('app', 'Started At'),
            'finished_at' => Yii::t('app', 'Finished At'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
            'variable' => Yii::t('app', 'Variable'),
            'desc' => Yii::t('app', 'Desc'),
            'remark' => Yii::t('app', 'Remark'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return ProjectJobQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjectJobQuery(get_called_class());
    }
	
	public function updateStatus($status){
		if($status == self::JOB_RUN_STARTED){
			$this->started_at = time();
		}else if($status == self::JOB_RUN_FINISHED || $status == self::JOB_RUN_FAILED){
			$this->finished_at = time();
		}else{
			throw new \Exception("status $status is not allow!");
		}
		$this->status = $status;
		$this->save();
	}


	public function getCommandScripts(){
		return $this->hasMany(CommandScript::className(), ['id' => 'script_id'])->via('commandActionScripts')->orderBy('order ASC');
	}

	public function getCommandActionScripts(){
		return $this->hasMany(CommandActionScript::className(), ['action_id' => 'action_id']);
	}
	
	public function getActionServers($active = false){
		$relate = $this->hasMany(Server::className(), ['id' => 'server_id'])->via('projectActionServers');
		return $active ? $relate->via('activeProjectActionServers') : $relate->via('projectActionServers');
	}

	public function getActiveActionServers(){
		return $this->getActionServers(true);
	}

	public function getProjectActionServers(){
		return $this->hasMany(ProjectActionServer::className(), ['project_id' => 'project_id', 'action_id' => 'action_id']);
	}

	public function getActiveProjectActionServers(){
		return $this->getProjectActionServers()->where(['status' => 1]);
	}

	public function getVariableArray(){
		return (Array)json_decode($this->variable, true);
	}

	public function getCommandJobs(){
		return $this->hasMany(CommandJob::className(), ['job_id' => 'id']);
	}

}
