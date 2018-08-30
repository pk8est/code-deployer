<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cd_server_group_server".
 *
 * @property string $id
 * @property int $server_group_id
 * @property int $server_id
 * @property int $status
 * @property int $order
 */
class ServerGroupServer extends \common\models\CommonModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cd_server_group_server';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['server_group_id', 'server_id', 'status', 'order'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'server_group_id' => Yii::t('app', 'Server Group ID'),
            'server_id' => Yii::t('app', 'Server ID'),
            'status' => Yii::t('app', 'Status'),
            'order' => Yii::t('app', 'Order'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return ServerGroupServerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ServerGroupServerQuery(get_called_class());
    }
}
