<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Depository]].
 *
 * @see Depository
 */
class DepositoryQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Depository[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Depository|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
