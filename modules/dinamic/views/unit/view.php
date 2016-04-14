<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\dinamic\models\Unit */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Units', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$temp = $model::template;
$mod = $model->getAll_elem($temp);
?>
<div class="unit-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id, 'temp' => $temp], ['class' => 'btn btn-primary']) ?>
        <?=
        Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ])
        ?>
    </p>
    <?php
    $arr_string[] = 'name';
    $arr_string[] = ['attribute' => 'template_id', 'value' => $model->template->name,];
    foreach ($mod as $key_ => $value_)
    {
        $arr_string[] = [
            'label' => $value_['name'],
            'value' => $model->getAll_value()[$model->id][$value_['id']],
        ];
    }
    ?>
    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => $arr_string
    ])
    ?>

</div>
