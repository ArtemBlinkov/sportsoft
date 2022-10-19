<?php

use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\imperavi\Widget;

/**
 * @var $this  yii\web\View
 * @var $model backend\modules\update\models\PageModel
 * @var $isNewRecord bool
 */

?>

<?php $form = ActiveForm::begin([
    'enableClientValidation' => false,
    'enableAjaxValidation' => true,
]) ?>

<?php echo $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

<?php echo $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

<?php echo $form->field($model, 'body')->widget(
    Widget::class,
    [
        'plugins' => ['fullscreen', 'fontcolor', 'video'],
        'options' => [
            'minHeight' => 400,
            'maxHeight' => 400,
            'buttonSource' => true,
            'imageUpload' => Yii::$app->urlManager->createUrl(['/file/storage/upload-imperavi']),
        ],
    ]
) ?>

<?php echo $form->field($model, 'view')->textInput(['maxlength' => true]) ?>

<?php echo $form->field($model, 'status')->checkbox() ?>

<div class="form-group">
    <?php echo Html::submitButton($isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end() ?>
