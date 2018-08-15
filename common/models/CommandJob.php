<?php

namespace common\models;

use Yii;
use common\models\ProjectJob;
use common\models\CommandScript;
use common\models\CommandStep;

/**
 * This is the model class for table "cd_command_job".
 *
 * @property string $id
 * @property int $job_id
 * @property int $script_id
 * @property int $step_id
 * @property string $runner run as
 * @property string $script
 * @property string $type script/step
 * @property int $status
 * @property string $server_ip
 * @property int $started_at
 * @property int $finished_at
 * @property int $created_at
 * @property string $updated_at
 * @property int $deleted_at
 * @property string $messages message
 * @property string $remark 备注
 */
class CommandJob extends \common\models\CommonModel
{
	const COMMAND_JOB_RUN_WAIT = 0;
	const COMMAND_JOB_RUN_STARTED = 1;
	const COMMAND_JOB_RUN_FINISHED = 10;
	const COMMAND_JOB_RUN_FAILED = -9;

	public static $statusArr = [
		self::COMMAND_JOB_RUN_WAIT => ['name' => '未执行', 'code' => ''],
		self::COMMAND_JOB_RUN_STARTED => ['name' => '执行中', 'code' => 'info'],
		self::COMMAND_JOB_RUN_FINISHED => ['name' => '成功', 'code' => 'success'],
		self::COMMAND_JOB_RUN_FAILED => ['name' => '失败', 'code' => 'danger'],
	];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cd_command_job';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['job_id', 'script_id', 'step_id', 'status', 'started_at', 'finished_at', 'created_at', 'deleted_at'], 'integer'],
            [['script'], 'required'],
            [['script', 'messages', 'remark'], 'string'],
            [['updated_at'], 'safe'],
            [['runner', 'type'], 'string', 'max' => 50],
            [['server_ip'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'job_id' => Yii::t('app', 'Job ID'),
            'script_id' => Yii::t('app', 'Script ID'),
            'step_id' => Yii::t('app', 'Step ID'),
            'runner' => Yii::t('app', 'Runner'),
            'script' => Yii::t('app', 'Script'),
            'type' => Yii::t('app', 'Type'),
            'status' => Yii::t('app', 'Status'),
            'server_ip' => Yii::t('app', 'Server Ip'),
            'started_at' => Yii::t('app', 'Started At'),
            'finished_at' => Yii::t('app', 'Finished At'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
            'messages' => Yii::t('app', 'Messages'),
            'remark' => Yii::t('app', 'Remark'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return CommandJobQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CommandJobQuery(get_called_class());
    }

	public static function build(ProjectJob $job, CommandScript $script = null, CommandStep $step = null){
		$commandJob = new static();
		$commandJob->creater_id = $job === null ? 0 : $job->creater_id;
		$commandJob->job_id = $job === null ? 0 : $job->id;
		$commandJob->script_id = $script === null ? 0 : $script->id;
		$commandJob->step_id = $step === null ? 0 : $step->id;
		$commandJob->type = $step === null ? 'script' : 'step';
		$commandJob->status = self::COMMAND_JOB_RUN_STARTED; 
		$commandJob->started_at = time();
		return $commandJob; 
	}

	public function getStatusInfo($key = null){
		if($key){
			return array_get(self::$statusArr, $this->status . '.' . $key, '');
		}else{
			return array_get(self::$statusArr, $this->status, []);
		}
	}

}
