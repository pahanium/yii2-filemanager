<?php

use pahanium\filemanager\assets\FilemanagerAsset;
use pahanium\filemanager\Module;
use pahanium\filemanager\models\Tag;
use yii\helpers\ArrayHelper;
use yii\widgets\ListView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel pahanium\filemanager\models\MediafileSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->params['moduleBundle'] = FilemanagerAsset::register($this);
?>

<header id="header"><span class="glyphicon glyphicon-picture"></span> <?= Module::t('main', 'File manager') ?></header>

<div id="filemanager" data-url-info="<?= Url::to(['file/info']) ?>">

	<?php $searchForm = $this->render('_search_form', ['model' => $model]) ?>
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'layout' => $searchForm . '<div class="items">{items}</div>{pager}',
        'showOnEmpty' => true,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
                    return Html::a(
                        Html::img($model->getDefaultThumbUrl($this->params['moduleBundle']->baseUrl))
                        . '<span class="checked glyphicon glyphicon-check"></span>',
                        '#mediafile',
                        ['data-key' => $key]
                    );
            },
    ]) ?>

    <div class="dashboard">
        <p><?= Html::a('<span class="glyphicon glyphicon-upload"></span> ' . Module::t('main', 'Upload manager'),
                ['file/uploadmanager', 'category_id' => $model->category_id], ['class' => 'btn btn-default']) ?></p>
        <div id="fileinfo">

        </div>
    </div>
</div>
