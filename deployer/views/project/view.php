<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $model common\models\Project */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Projects'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="project-view box box-primary">
    <div class="box-header">
        <?= Helper::checkRoute('update') ? Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-flat']) : '' ?>
        <?= Helper::checkRoute('delete') ? Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger btn-flat',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) : '' ?>
		<?= Html::a(Yii::t('app', 'Return List'), ['index'], ['class' => 'btn btn-info btn-flat pull-right']) ?>
    </div>
    <div class="box-body table-responsive">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'creater_id',
                'project_group_id',
                'name',
                'repo_type',
                'repo_address',
                'repo_account',
                'repo_password',
                'repo_private_key',
                'repo_branch',
                'desc',
                'status',
                'type',
                'published_at',
                'created_at:datetime',
                'updated_at:datetime',
                'deleted_at',
                'order',
                'remark:ntext',
            ],
        ]) ?>
    </div>
	<div class="box-footer">
		<?php 
			if(Helper::checkRoute('/deployment/deploy')){
				foreach($model->commandActions as $key => $commandAction){
					echo  Html::a(Yii::t('app', $commandAction->name), ['/deployment/deploy', 'id' => $model->id, 'action_id' => $commandAction->id], ['class' => 'btn btn-success btn-flat', 'target' => '_brank']);
				}
			} 
		?>
	</div>
</div>
