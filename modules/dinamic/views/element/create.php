<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\dinamic\models\Element */

$this->title = 'Create Element';
$this->params['breadcrumbs'][] = ['label' => 'Elements', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="element-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
