<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cd_server".
 *
 * @property string $id
 * @property int $room_id 机房
 * @property int $creater_id 创建人ID
 * @property string $name
 * @property string $desc
 * @property string $ip 外网
 * @property string $inner_ip 内网
 * @property string $ssh_private_key
 * @property int $status
 * @property string $type 类型
 * @property string $level 级别
 * @property int $created_at
 * @property string $updated_at
 * @property int $deleted_at
 * @property int $order
 * @property string $remark 备注
 */
class Server extends \common\models\CommonModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cd_server';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['room_id', 'creater_id', 'status', 'created_at', 'deleted_at', 'order'], 'integer'],
            [['updated_at'], 'safe'],
            [['remark'], 'string'],
            [['name', 'ip', 'inner_ip'], 'string', 'max' => 255],
            [['desc', 'ssh_private_key'], 'string', 'max' => 1000],
            [['type', 'level'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'room_id' => Yii::t('app', 'Room ID'),
            'creater_id' => Yii::t('app', 'Creater ID'),
            'name' => Yii::t('app', 'Name'),
            'desc' => Yii::t('app', 'Desc'),
            'ip' => Yii::t('app', 'Ip'),
            'inner_ip' => Yii::t('app', 'Inner Ip'),
            'ssh_private_key' => Yii::t('app', 'Ssh Private Key'),
            'status' => Yii::t('app', 'Status'),
            'type' => Yii::t('app', 'Type'),
            'level' => Yii::t('app', 'Level'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
            'order' => Yii::t('app', 'Order'),
            'remark' => Yii::t('app', 'Remark'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return ServerQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ServerQuery(get_called_class());
    }
}
