<?php

namespace common\models;

use Yii;
use common\models\CommandScript;

/**
 * This is the model class for table "cd_command_action".
 *
 * @property string $id
 * @property int $creater_id 创建人ID
 * @property string $name
 * @property int $status
 * @property string $type 类型
 * @property int $created_at
 * @property string $updated_at
 * @property int $deleted_at
 * @property int $order
 * @property string $remark 备注
 */
class CommandAction extends \common\models\CommonModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cd_command_action';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
			[['name'], 'required'],
            [['creater_id', 'status', 'created_at', 'deleted_at', 'order'], 'integer'],
            [['updated_at'], 'safe'],
            [['remark'], 'string'],
            [['name'], 'string', 'max' => 255],
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
            'creater_id' => Yii::t('app', 'Creater ID'),
            'name' => Yii::t('app', 'Name'),
            'status' => Yii::t('app', 'Status'),
            'type' => Yii::t('app', 'Type'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
            'order' => Yii::t('app', 'Order'),
            'remark' => Yii::t('app', 'Remark'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return CommandActionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CommandActionQuery(get_called_class());
    }

	public function getCommandScripts(){
		return $this->getCommandActionScripts()->joinWith('commandScript')->all();
	}
	

	public function getCommandActionScripts(){
		return $this->hasMany(CommandActionScript::className(), ['action_id' => 'id'])->orderBy('`order` ASC');
	}

	public function updateCommandActionScripts($commandActionScripts, $delet = false){
		$commandScripts = [];
        foreach($commandActionScripts as $key => $value){
            $commandScripts[] = ['action_id' => $this->id, 'script_id' => $value['id'], 'order' => $key];
        }
		if($delet){
        	CommandActionScript::deleteAll(['action_id' => $this->id]);
		}
        if(count($commandScripts) > 0){
           Yii::$app->db->createCommand()->batchInsert(CommandActionScript::tableName(), array_keys($commandScripts[0]), $commandScripts)->execute();
        }
	}

}

