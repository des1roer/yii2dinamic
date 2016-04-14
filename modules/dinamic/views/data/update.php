<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\dinamic\models\Data */

$this->title = 'Update Data: ' . $model->unit_id;
$this->params['breadcrumbs'][] = ['label' => 'Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->unit_id, 'url' => ['view', 'unit_id' => $model->unit_id, 'element_id' => $model->element_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="data-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
