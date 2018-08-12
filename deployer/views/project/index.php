<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel deployer\models\ProjectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Projects');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-index box box-primary">
    <?php Pjax::begin(); ?>
    <div class="box-header with-border">
        <?= Html::a(Yii::t('app', 'Create Project'), ['create'], ['class' => 'btn btn-info btn-flat pull-right']) ?>
    </div>
    <div class="box-body table-responsive no-padding">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'creater_id',
                [
                    'label' => '项目分组',
                    'value' => 'projectGroup.name',
                    'attribute' => 'project_group_id',
                    'filter' => ArrayHelper::map($projectGroups, 'id', 'name'),
                    'filterInputOptions' => [
                        'class' => 'form-control',
                        'prompt' => '--全部--'
                    ],
                ],
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
                'created_at:date',
                // 'updated_at',
                // 'deleted_at',
                // 'order',
                // 'remark:ntext',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
    <?php Pjax::end(); ?>
</div>
