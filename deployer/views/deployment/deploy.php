<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $model common\models\Project */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Deployment'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<style>
pre.linux-style {
	background-color: #333;
    border-radius: 0;
    color: #fff;
    margin: 0;
    padding: 1em;
	border: 1px solid rgba(0, 0, 0, 0.15);
    border-radius: 4px;
}
</style>

	<?= Html::errorSummary($model, ['class' => 'error-summary']) ?>
<div class ="row">
	<?php foreach($model->commandJobs as $commandJob){ ?>
		<div class="col-xs-12">
            <div class="box box-info deploy-step">
                <div class="box-header">
                    <h3 class="box-title"><i class="fa fa-terminal"></i> <span><?= $commandJob->name ?></span></h3>
                </div>
                <div class="box-body table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>服务器</th>
                                <th>执行用户</th>
								<th>脚本类型</th>
								<th>开始时间</th>
								<th>结束时间</th>
								<th>执行状态</th>
                            </tr>
                        </thead>
						<tbody>
                            <tr>
                                <td><?= $commandJob->server_ip ?></td>
                                <td><?= $commandJob->runner ? : 'root' ?></td>
                                <td><?= $commandJob->type ?></td>
                                <td><?= Yii::$app->formatter->asDateTime($commandJob->started_at) ?></td>
                                <td><?= Yii::$app->formatter->asDateTime($commandJob->finished_at) ?></td>
                                <td><span class="label label-<?= $commandJob->getStatusInfo('code') ?>"><?= $commandJob->getStatusInfo('name') ?></span></td>
                            </tr>
                        </tbody>
                        <tbody id="">

                        </tbody>
                    </table>
					<pre class="linux-style"><?= $comandJob->runner ? : 'root' . '@' . $commandJob->server_ip . ':$ '  .  $commandJob->script . "\n" . $commandJob->messages ?></pre>
                </div>
            </div>
        </div>
	<?php } ?>	
</div>

