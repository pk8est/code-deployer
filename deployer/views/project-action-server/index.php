<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax; 
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel deployer\models\ProjectActionServerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Project Action Servers');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-action-server-index box box-primary">
    <?php Pjax::begin(); ?>
    <div class="box-header with-border">
        <?= Helper::checkRoute('create') ? Html::a(Yii::t('app', 'Create Project Action Server'), ['create'], ['class' => 'btn btn-info btn-flat pull-right']) : "" ?>
    </div>
    <div class="box-body table-responsive">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'project_id',
                'action_id',
                'server_id',
                'status',
                // 'order',

				[
                    'class' => 'yii\grid\ActionColumn',
					'template' => '<div class="btn-group">'.Helper::filterActionColumn(['view', 'update', 'delete']).'</div>',
                ],
            ],
        ]); ?>
    </div>
    <?php Pjax::end(); ?>
</div>
