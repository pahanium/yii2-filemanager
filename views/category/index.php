<?php

use pahanium\filemanager\Module;
use yii\bootstrap\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Module::t('main', 'File Manager Category');
$this->params['breadcrumbs'][] = ['label' => Module::t('main', 'File manager'), 'url' => ['default/index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="filemanager-category-index">
    <h1><?= $this->title ?></h1>
    <p>
        <?= Html::a(Module::t('main', 'Create Category'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'name',
                'value' => function($model) {
                    return Html::tag('span', $model->name, ['style' => 'margin-left:' . 20 * $model->depth . 'px']);
                },
                'format' => 'raw',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{up} {down} {update} {delete}',
                'buttons' => [
                    'up' => function ($url) {
                        return Html::a('<span class="glyphicon glyphicon-triangle-top"></span>', $url);
                    },
                    'down' => function ($url) {
                        return Html::a('<span class="glyphicon glyphicon-triangle-bottom"></span>', $url);
                    },
                ],
            ],
        ],
    ]); ?>
</div>
