<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cd_depository".
 *
 * @property int $id ID
 * @property string $type 1:git/2:svn
 * @property string $address 地址
 * @property string $account svn生效
 * @property string $password svn生效
 * @property string $private_key git生效
 * @property string $public_key git生效
 * @property int $status 状态
 * @property int $created_at
 * @property string $updated_at
 * @property int $deleted_at
 * @property int $order
 * @property string $remark 备注
 */
class Depository extends \common\models\CommonModel
{
	const STATUS_NORMAL = 1;
    const STATUS_DISABLE = -1;	

	public static function getStatusArr() {
		return [
			self::STATUS_NORMAL => ['name' => '正常', 'code' => 'info'],
            self::STATUS_DISABLE => ['name' => '停用', 'code' => 'danger'],
		];
	}
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cd_depository';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
			[['address', 'type', 'status'], 'required'],
            [['type', 'remark'], 'string'],
			['order', 'default', 'value' => 0],
            [['status', 'created_at', 'deleted_at', 'order'], 'integer', 'skipOnEmpty' => true],
            [['updated_at'], 'safe'],
            [['address', 'account', 'password'], 'string', 'max' => 100],
            [['private_key', 'public_key'], 'string', 'max' => 1000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type' => Yii::t('app', 'Type'),
            'address' => Yii::t('app', 'Address'),
            'account' => Yii::t('app', 'Account'),
            'password' => Yii::t('app', 'Password'),
            'private_key' => Yii::t('app', 'Private Key'),
            'public_key' => Yii::t('app', 'Public Key'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'deleted_at' => Yii::t('app', 'Deleted At'),
            'order' => Yii::t('app', 'Order'),
            'remark' => Yii::t('app', 'Remark'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return DepositoryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DepositoryQuery(get_called_class());
    }
}
