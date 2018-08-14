<?php

namespace common\models;

use Yii;
use common\models\CommandScript;

/**
 * This is the model class for table "cd_command_action_script".
 *
 * @property string $id
 * @property int $action_id
 * @property int $script_id
 * @property int $order
 */
class CommandActionScript extends \common\models\CommonModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cd_command_action_script';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['action_id', 'script_id', 'order'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'action_id' => Yii::t('app', 'Action ID'),
            'script_id' => Yii::t('app', 'Script ID'),
            'order' => Yii::t('app', 'Order'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return CommandActionScriptQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CommandActionScriptQuery(get_called_class());
    }
	
	public function getCommandScript(){
		return $this->hasOne(CommandScript::class, ['id' => 'script_id']);
	}

}
