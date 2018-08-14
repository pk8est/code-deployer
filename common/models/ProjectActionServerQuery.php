<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[ProjectActionServer]].
 *
 * @see ProjectActionServer
 */
class ProjectActionServerQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjectActionServer[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjectActionServer|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
