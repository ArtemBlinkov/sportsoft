<?php

use backend\modules\update\models\PageModel;
use common\grid\EnumColumn;
use common\widgets\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;

/**
 * @var $this         yii\web\View
 * @var $searchModel  backend\modules\update\models\SearchModel
 * @var $dataProvider yii\data\ActiveDataProvider
 */

$this->title = Yii::t('backend', 'Static pages');

$this->params['breadcrumbs'][] = $this->title;

?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'options' => [
        'class' => 'grid-view table-responsive',
    ],
    'columns' => [
        [
            'attribute' => 'id',
        ],
        [
            'attribute' => 'title',
            'value' => function ($searchModel) {
                return Html::a(Html::encode($searchModel->title), null, [
                    'target' => '_blank',
                    'href' => Yii::getAlias('@frontendUrl') . '/page/' . $searchModel->slug
                ]);
            },
            'format' => 'raw',
        ],
        [
            'attribute' => 'slug',
        ],
        [
            'class' => EnumColumn::class,
            'attribute' => 'status',
            'enum' => PageModel::statuses(),
            'filter' => PageModel::statuses(),
        ],
        [
            'header' => 'Update',
            'class' => ActionColumn::class,
            'template' => '{update}',
        ]
    ],
]); ?>
