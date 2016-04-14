<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\dinamic\models\Unit */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
$request = Yii::$app->request;
$id = null;
$id = $request->get('temp');

if (!$model->isNewRecord)
    $param = $model->getAll_value($model->id);

?>
<div class="unit-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?php
    $mod = $model->getAll_elem($id);
        
    if ($mod)
        foreach ($mod as $key => $value)
        {
            if ($param[$value['id'] ]) $val = $param[$value['id']];
            ?>
            <label class="control-label" for="username"><?= $value['name'] ?></label>
            <?= Html::input('text', "elem[" . $value['id'] . "]", $val, ['class' => 'form-control']) ?>
            <?php
        }
    ?>
    <hr/>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
