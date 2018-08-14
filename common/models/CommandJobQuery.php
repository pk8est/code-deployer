<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[CommandJob]].
 *
 * @see CommandJob
 */
class CommandJobQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CommandJob[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CommandJob|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
