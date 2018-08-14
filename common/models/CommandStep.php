<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cd_command_step".
 *
 * @property string $id
 * @property string $name
 * @property string $script
 * @property int $script_id
 * @property string $type 类型
 * @property string $is_local 0:远程, 1:本地
 * @property int $status
 * @property string $action_type 1:before, 2:after
 * @property int $optional 可选
 * @property string $condition 条件
 * @property string $runner run as
 * @property int $created_at
 * @property string $updated_at
 * @property int $deleted_at
 * @property int $order
 * @property string $remark 备注
 */
class CommandStep extends \common\models\CommonModel
{

	const ACTION_TYPE_BEFORE = 1;
	const ACTION_TYPE_AFTER  = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cd_command_step';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['script'], 'required'],
            [['script', 'is_local', 'action_type', 'remark'], 'string'],
            [['script_id', 'status', 'optional', 'created_at', 'deleted_at', 'order'], 'integer'],
            [['updated_at'], 'safe'],
            [['name', 'condition'], 'string', 'max' => 255],
            [['type', 'runner'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'script' => Yii::t('app', 'Script'),
            'script_id' => Yii::t('app', 'Script ID'),
            'type' => Yii::t('app', 'Type'),
            'is_local' => Yii::t('app', 'Is Local'),
            'status' => Yii::t('app', 'Status'),
            'action_type' => Yii::t('app', 'Action Type'),
            'optional' => Yii::t('app', 'Optional'),
            'condition' => Yii::t('app', 'Condition'),
            'runner' => Yii::t('app', 'Runner'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
            'order' => Yii::t('app', 'Order'),
            'remark' => Yii::t('app', 'Remark'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return CommandStepQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CommandStepQuery(get_called_class());
    }
}
