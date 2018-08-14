<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cd_project_action_server".
 *
 * @property string $id
 * @property int $project_id
 * @property int $action_id
 * @property int $server_id
 * @property int $order
 */
class ProjectActionServer extends \common\models\CommonModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cd_project_action_server';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project_id', 'action_id', 'server_id', 'order'], 'integer'],
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
            'server_id' => Yii::t('app', 'Server ID'),
            'order' => Yii::t('app', 'Order'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return ProjectActionServerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjectActionServerQuery(get_called_class());
    }
}
