<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cd_project".
 *
 * @property string $id
 * @property int $creater_id 创建人ID
 * @property int $project_group_id
 * @property string $name
 * @property int $repo_type 1:git,2:svn
 * @property string $repo_address
 * @property string $repo_account
 * @property string $repo_password
 * @property string $repo_private_key
 * @property string $repo_branch
 * @property string $desc
 * @property int $status
 * @property string $type 类型
 * @property int $published_at
 * @property int $created_at
 * @property string $updated_at
 * @property int $deleted_at
 * @property int $order
 * @property string $remark 备注
 */
class Project extends CommonModel
{
	const STATUS_NORMAL = 1;
	const STATUS_DISABLE = -1;
	const REPO_TYPE_DEPO = 1;
	const REPO_TYPE_CUSTOM = 2;

	public static function getStatusArr(){
		return [
            self::STATUS_NORMAL => ['name' => '正常', 'code' => 'info'],
            self::STATUS_DISABLE => ['name' => '停用', 'code' => 'danger'],
        ];
	}

	public static function getRepoTypeArr(){
		return [
			self::REPO_TYPE_DEPO => ['name' => '仓库'],
			self::REPO_TYPE_CUSTOM => ['name' => '自定义'],
		];
	}

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cd_project';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project_group_id', 'name', 'repo_type'], 'required'],
            [['creater_id', 'repo_id', 'project_group_id', 'repo_type', 'status', 'published_at', 'created_at', 'deleted_at', 'order'], 'integer'],
            [['updated_at'], 'safe'],
            [['remark'], 'string'],
            [['name', 'repo_account', 'repo_password'], 'string', 'max' => 255],
            [['repo_address', 'repo_private_key', 'desc'], 'string', 'max' => 1000],
            [['repo_branch', 'type'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'creater_id' => Yii::t('app', 'Creater ID'),
            'project_group_id' => Yii::t('app', 'Project Group ID'),
            'name' => Yii::t('app', 'Name'),
            'repo_type' => Yii::t('app', 'Repo Type'),
            'repo_address' => Yii::t('app', 'Repo Address'),
            'repo_account' => Yii::t('app', 'Repo Account'),
            'repo_password' => Yii::t('app', 'Repo Password'),
            'repo_private_key' => Yii::t('app', 'Repo Private Key'),
            'repo_branch' => Yii::t('app', 'Repo Branch'),
            'desc' => Yii::t('app', 'Desc'),
            'status' => Yii::t('app', 'Status'),
            'type' => Yii::t('app', 'Type'),
            'published_at' => Yii::t('app', 'Published At'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
            'order' => Yii::t('app', 'Order'),
            'remark' => Yii::t('app', 'Remark'),
        ];
    }

    public function getProjectGroup()
    {
        return $this->hasOne(ProjectGroup::className(), ['id' => 'project_group_id']);
    }

	public function getCommandActions(){
		return $this->hasMany(CommandAction::className(), ['id' => 'action_id'])->via('projectActions');
	}
	
	public function getProjectActions(){
		return $this->HasMany(ProjectAction::className(), ['project_id' => 'id']);
	}

	public function getDepository(){
		return $this->hasOne(Depository::className(), ['id' => 'repo_id']);
	}
	
    public function afterFind()
    {
        return parent::afterFind();
    }
}
