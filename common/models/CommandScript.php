<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cd_command_script".
 *
 * @property string $id
 * @property int $creater_id 创建人ID
 * @property string $name
 * @property string $script
 * @property string $runner run as
 * @property int $status
 * @property string $type 类型
 * @property string $is_local 0:远程, 1:本地
 * @property int $created_at
 * @property string $updated_at
 * @property int $deleted_at
 * @property int $order
 * @property string $remark 备注
 */
class CommandScript extends \common\models\CommonModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cd_command_script';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['creater_id', 'status', 'created_at', 'deleted_at', 'order'], 'integer'],
            [['script'], 'required'],
            [['script', 'is_local', 'remark'], 'string'],
            [['updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['runner', 'type'], 'string', 'max' => 50],
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
            'name' => Yii::t('app', 'Name'),
            'script' => Yii::t('app', 'Script'),
            'runner' => Yii::t('app', 'Runner'),
            'status' => Yii::t('app', 'Status'),
            'type' => Yii::t('app', 'Type'),
            'is_local' => Yii::t('app', 'Is Local'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
            'order' => Yii::t('app', 'Order'),
            'remark' => Yii::t('app', 'Remark'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return CommandScriptQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CommandScriptQuery(get_called_class());
    }
	
	public function getBeforeSteps(){
        return $this->getCommandSteps(CommandStep::ACTION_TYPE_BEFORE);          
    }                                                                            
    
    public function getAfterSteps(){
        return $this->getCommandSteps(CommandStep::ACTION_TYPE_AFTER);           
    }                                                                            
    
    public function getCommandSteps($actionType = 1){
        return $this->hasMany(CommandStep::className(), ['script_id' => 'id'])->where(['action_type' => $actionType])->orderBy('order ASC');                       
    } 

	public function getScriptUnix(){
		return str_replace("\r\n","\n",$this->script);
	} 

}
