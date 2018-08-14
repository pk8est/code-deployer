<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[ProjectAction]].
 *
 * @see ProjectAction
 */
class ProjectActionQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ProjectAction[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ProjectAction|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
