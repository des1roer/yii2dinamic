<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\dinamic\models\Data */

$this->title = $model->unit_id;
$this->params['breadcrumbs'][] = ['label' => 'Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'unit_id' => $model->unit_id, 'element_id' => $model->element_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'unit_id' => $model->unit_id, 'element_id' => $model->element_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'unit_id',
            'element_id',
            'value',
        ],
    ]) ?>

</div>
