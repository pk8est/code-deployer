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

    /**
     * {@inheritdoc}
     * @return ProjectActionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProjectActionQuery(get_called_class());
    }

}
