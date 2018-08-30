<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cd_server_group".
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
class ServerGroup extends \common\models\CommonModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cd_server_group';
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
     * @return ServerGroupQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ServerGroupQuery(get_called_class());
    }


	public function getServers(){
		return $this->hasMany(Server::className(), ['id' => 'server_id'])->via('groupServerMap');
	}

	public function getGroupServerMap(){
		return $this->hasMany(ServerGroupServer::className(), ['server_group_id' => 'id']);
	}

	public function updateMany($array, $delete = false){
        $data = [];
        foreach($array as $key => $value){
            $data[] = ['server_group_id' => $this->id, 'server_id' => $value, 'order' => $key];
        }
        if($delete){
            ServerGroupServer::deleteAll(['server_group_id' => $this->id]);
        }
        if(count($data) > 0){
           Yii::$app->db->createCommand()->batchInsert(ServerGroupServer::tableName(), array_keys($data[0]), $data)->execute();
        }
    }	

}
