<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[CommandActionScript]].
 *
 * @see CommandActionScript
 */
class CommandActionScriptQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CommandActionScript[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CommandActionScript|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
