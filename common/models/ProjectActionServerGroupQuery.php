<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[ProjectActionServerGroup]].
 *
 * @see ProjectActionServerGroup
 */
class ProjectActionServerGroupQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjectActionServerGroup[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjectActionServerGroup|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
