<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax; 
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel deployer\models\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Projects');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index box box-primary">
    <?php Pjax::begin(); ?>
    <div class="box-header with-border">
        <?= Helper::checkRoute('create') ? Html::a(Yii::t('app', 'Create Project'), ['create'], ['class' => 'btn btn-info btn-flat pull-right']) : "" ?>
    </div>
    <div class="box-body table-responsive ">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'creater_id',
                'project_group_id',
                'name',
                'repo_type',
                // 'repo_address',
                // 'repo_account',
                // 'repo_password',
                // 'repo_private_key',
                // 'repo_branch',
                // 'desc',
                // 'status',
                // 'type',
                // 'published_at',
                // 'created_at',
                // 'updated_at',
                // 'deleted_at',
                // 'order',
                // 'remark:ntext',

				[
                    'class' => 'yii\grid\ActionColumn',
					'template' => '<div class="btn-group">'.Helper::filterActionColumn(['view', 'update', 'delete']).'</div>',
                ],
            ],
        ]); ?>
    </div>
    <?php Pjax::end(); ?>
</div>
