<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Salesman */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="salesman-form form-inline">

    <?php $form = ActiveForm::begin(); ?>

    <div class='col-md-4 col-sm-6 col-xs-12'>
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    </div>
    <div class='col-md-4 col-sm-6 col-xs-12'>
        <?= $form->field($model, 'value')->textInput() ?>

    </div>
    <div class='col-md-4 col-sm-6 col-xs-12'>
        <div class="form-group">
            <label style="margin-top: 20px;">
                <input type="checkbox" id="queue-order" name="check" checkvalue="1" uncheckValue="0" />
                Set as Default
            </label>
        </div>

    </div>
    <div class='col-md-4 col-sm-6 col-xs-12'>
        <?= $form->field($model, 'status')->dropDownList(['1' => 'Enabled', '0' => 'Disabled']) ?>

    </div>
    <div class="form-group" style="float: right;">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary', 'style' => 'margin-top: 18px; height: 36px; width:100px;']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
