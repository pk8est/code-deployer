<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[CommandScript]].
 *
 * @see CommandScript
 */
class CommandScriptQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CommandScript[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CommandScript|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
