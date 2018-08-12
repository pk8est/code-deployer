<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cd_server_room".
 *
 * @property string $id
 * @property int $creater_id 创建人ID
 * @property string $name
 * @property string $desc
 * @property int $status
 * @property string $type 类型
 * @property int $created_at
 * @property string $updated_at
 * @property int $deleted_at
 * @property int $order
 * @property string $remark 备注
 */
class ServerRoom extends \common\models\CommonModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cd_server_room';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['creater_id', 'status', 'created_at', 'deleted_at', 'order'], 'integer'],
            [['updated_at'], 'safe'],
            [['remark'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['desc'], 'string', 'max' => 1000],
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
            'desc' => Yii::t('app', 'Desc'),
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
     * @return ServerRoomQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ServerRoomQuery(get_called_class());
    }
}
