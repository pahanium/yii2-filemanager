<?php

use pahanium\filemanager\Module;

/* @var $this yii\web\View */
/* @var $model pahanium\filemanager\models\Category */

$this->title = Module::t('main', 'Create Category');
$this->params['breadcrumbs'][] = ['label' => Module::t('main', 'File manager'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = ['label' => Module::t('main', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="filemanager-category-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
