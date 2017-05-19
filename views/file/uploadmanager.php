<?php
use dosamigos\fileupload\FileUploadUI;
use pahanium\filemanager\Module;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel pahanium\filemanager\models\Mediafile */
/* @var $category_id integer */

?>

<header id="header"><span class="glyphicon glyphicon-upload"></span> <?= Module::t('main', 'Upload manager') ?></header>

<div id="uploadmanager">
    <p><?= Html::a('← ' . Module::t('main', 'Back to file manager'), ['file/filemanager', 'MediafileSearch[category_id]' => $category_id]) ?></p>
    <?= FileUploadUI::widget([
        'model' => $model,
        'attribute' => 'file',
        'clientOptions' => [
            'autoUpload'=> Yii::$app->getModule('filemanager')->autoUpload,
        ],
        'clientEvents' => [
            'fileuploadsubmit' => "function (e, data) { data.formData = [{name: 'tagIds', value: $('#filemanager-tagIds').val()},{name: 'category_id', value: '" . $category_id . "'}]; }",
        ],
        'url' => ['upload'],
        'gallery' => false,
        'formView' => '/file/_upload_form',
    ]) ?>
</div>
