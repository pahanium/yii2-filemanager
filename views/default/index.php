<?php

use yii\helpers\Html;
use pahanium\filemanager\Module;
use pahanium\filemanager\assets\FilemanagerAsset;

/* @var $this yii\web\View */

$this->title = Module::t('main', 'File manager');
$this->params['breadcrumbs'][] = $this->title;

$assetPath = FilemanagerAsset::register($this)->baseUrl;
?>

<div class="filemanager-default-index">
    <h1><?= Module::t('main', 'File manager module'); ?></h1>

    <div class="row">
        <div class="col-md-4">

            <div class="text-center">
                <h2>
                    <?= Html::a(Module::t('main', 'Files'), ['file/index']) ?>
                </h2>
                <?= Html::a(
                    Html::img($assetPath . '/images/files.png', ['alt' => 'Files'])
                    , ['file/index']
                ) ?>
            </div>
        </div>

        <div class="col-md-4">

            <div class="text-center">
                <h2>
                    <?= Html::a(Module::t('main', 'Categories'), ['category/index']) ?>
                </h2>
                <?= Html::a(
                    Html::img($assetPath . '/images/categories.png', ['alt' => 'Files'])
                    , ['category/index']
                ) ?>
            </div>
        </div>

        <div class="col-md-4">

            <div class="text-center">
                <h2>
                    <?= Html::a(Module::t('main', 'Settings'), ['default/settings']) ?>
                </h2>
                <?= Html::a(
                    Html::img($assetPath . '/images/settings.png', ['alt' => 'Tools'])
                    , ['default/settings']
                ) ?>
            </div>
        </div>
    </div>
</div>
