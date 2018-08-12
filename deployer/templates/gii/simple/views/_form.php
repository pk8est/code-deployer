<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

/* @var $model \yii\db\ActiveRecord */
$model = new $generator->modelClass();
$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
    $safeAttributes = $model->attributes();
}

$urlParams = $generator->generateUrlParams();

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use mdm\admin\components\Helper;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-form box box-primary">
    <?= "<?php " ?>$form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive row">
        <div class="col-sm-6">
<?php 
	$attributes = [];
	foreach ($generator->getColumnNames() as $attribute) {
    	if (in_array($attribute, $safeAttributes)) {
			$attributes[] = $attribute;
		}
    }
	$length = count($attributes);
	for($i = 0; $i < $length; $i+=2){
		echo "        <?= " . $generator->generateActiveField($attributes[$i]) . " ?>\n\n";	
	}
?>
		</div>
		<div class="col-sm-6">
<?php 
    for($i = 1; $i < $length; $i+=2){
        echo "        <?= " . $generator->generateActiveField($attributes[$i]) . " ?>\n\n";
    }
?>
        </div>
    </div>
    <div class="box-footer">
        <?= "<?= " ?>Helper::checkRoute('view') && $model->getPrimaryKey() ? Html::a(<?= $generator->generateString('View') ?>, ['view',  <?= $urlParams ?>], ['class' => 'btn btn-success btn-flat']) : '' ?>
        <?= "<?= " ?>Helper::checkRoute('index') ? Html::a(<?= $generator->generateString('Return List') ?>, ['index'], ['class' => 'btn btn-info btn-flat']) : '' ?>
        <?= "<?= " ?>Helper::checkRoute('update') ? Html::submitButton(<?= $generator->generateString('Save') ?>, ['class' => 'btn btn-danger btn-flat']) : '' ?>
    </div>
    <?= "<?php " ?>ActiveForm::end(); ?>
</div>
