<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[ServerRoom]].
 *
 * @see ServerRoom
 */
class ServerRoomQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ServerRoom[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ServerRoom|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
