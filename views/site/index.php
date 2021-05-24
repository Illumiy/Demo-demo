<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'My Yii Application';

$script = <<< JS
$(document).ready(function() {
    setInterval(function(){ $("#refreshButton").click();  }, 5000);
});
JS;
$this->registerJs($script);
?>
<div class="site-index">
    <? if(!Yii::$app->user->isGuest) : ?>
    <p>
        <?= Html::a('Создать заявку', ['/front/create'], ['class' => 'btn btn-success']) ?>
    </p>
    <? endif; ?>
 
    <?php \yii\widgets\Pjax::begin(); ?>
        <?= Html::a("Обновить", ['site/index'], ['class' => 'btn btn-lg btn-primary hidden', 'id'=> "refreshButton"]) ?>
        <h1>Количество рещенных заявок: <?= $count?></h1>
    <?php \yii\widgets\Pjax::end(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'category_id',
                'value' => 'category.name',
                'filter' => \yii\helpers\ArrayHelper::map(\app\modules\admin\models\Category::find()->all(), 'id', 'name'),
            ],
            // 'id',
            'status',
            'name',
            'before_img',
            [
                'attribute'=> 'before_img',
                'value'=> function($model){
                    return Html::img($model->before_img,['width'=> 100]);
                },
                'format'=> 'html'
            ],
            'after_img',
            [
                'attribute'=> 'after_img',
                'value'=> function($model){
                    return Html::img($model->after_img,['width'=> 100]);
                },
                'format'=> 'html'
            ],
        ]
    ]);?>

</div>
