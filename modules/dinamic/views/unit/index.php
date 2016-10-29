<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\modules\dinamic\models\Unit;
use yii\helpers\ArrayHelper;
use app\modules\dinamic\models\Template;
/* @var $this yii\web\View */
/* @var $searchModel app\modules\dinamic\models\UnitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Units';
$this->params['breadcrumbs'][] = $this->title;

$temp = Unit::template;
$model = new Unit();
$mod = $model->getAll_elem($temp);

if (empty($mod)) return  Yii::$app->response->redirect(\yii\helpers\Url::to(['./']));
    
$arr_cols = [];
$arr_cols[] = ['class' => 'yii\grid\SerialColumn'];
$arr_cols[] = 'name';
$arr_cols[] = [
    'attribute' => 'template_id',
    'format' => 'raw',
    // 'label' => 'раса',
    'filter' => ArrayHelper::map(Template::find()->all(), 'id', 'name'),
    'value' => 'template.name'
];

foreach ($mod as $key_ => $value_)
{
    $arr_cols[] = [
        'class' => 'yii\grid\DataColumn',
        'header' => $value_['name'],
        'value' => function($data) use ($value_) {
            return $data->getAll_value()[$data->id][$value_['id']];
        },
    ];
}
$arr_cols[] = ['class' => \yii\grid\ActionColumn::className(),
    'buttons' => [
        'update' => function ($url, $model) {
            $customurl = Yii::$app->getUrlManager()->createUrl(['dinamic/unit/update', 'id' => $model['id'], 'temp' => $model::template]);
            return \yii\helpers\Html::a('<span class="glyphicon glyphicon-pencil"></span>', $customurl, ['title' => Yii::t('yii', 'Update'), 'data-pjax' => '0']);
        }
            ],
        ];
        ?>
        <div class="unit-index">

            <h1><?= Html::encode($this->title) ?></h1>
            <?php // echo $this->render('_search', ['model' => $searchModel]);     ?>  
            <p>
                <?= Html::a('Create Unit', ['create?temp=' . $temp], ['class' => 'btn btn-success']) ?>
            </p>
            <?php Pjax::begin(); ?>    

            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => $arr_cols
            ]);
            ?>
            <?php Pjax::end(); ?></div>
