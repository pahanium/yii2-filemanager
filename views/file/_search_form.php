<?php

use pahanium\filemanager\models\Category;
use pahanium\filemanager\Module;
use pahanium\filemanager\models\Tag;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
?>
<?php $form = ActiveForm::begin(['method' => 'get']) ?>
	<?= $form->field($model, 'tagIds')->widget(\kartik\select2\Select2::className(), [
		'maintainOrder' => true,
		'data' => ArrayHelper::map(Tag::find()->all(), 'id', 'name'),
		'options' => ['multiple' => true],
		'addon' => [
			'append' => [
				'content' => Html::submitButton(Module::t('main', 'Search'), ['class' => 'btn btn-primary']),
				'asButton' => true
			]
		]
	])->label(false) ?>

	<?= $form->field($model, 'category_id')->dropDownList(
		Category::getTreeList(),
		[
			'prompt' => Module::t('main', 'Select category...'),
            'onchange' => 'this.form.submit()',
		])->label(false) ?>
<?php ActiveForm::end() ?>
