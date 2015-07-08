<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Location */
$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Locations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="location-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            'lat',
            'lon',
            [
                'attribute' => 'subregion',
                'value' => $model->subregion->title,
            ],
        ],
    ]) ?>

    <ul>
        <?php
        $page = !is_null(Yii::$app->request->get('page')) ? Yii::$app->request->get('page') : 1;
        $limit = 20;
        $total = count($model->getPastData());
        foreach ($model->getPastData($page, $limit) as $item) : ?>
        <li>
            <?=$item->date?>
        </li>
        <?php endforeach; ?>
    </ul>

    <ul class="pagination">
        <li class="prev<?php if ($page == 1) echo ' disabled';?>">
            <?php if ($page > 1)
            {
                echo '<a href="/location/' . $model->id . '?page=' . ($page - 1) . '">&laquo;</a>';
            }
            else
            {
                echo '<span>&laquo;</span>';
            }
            ?>
        </li>
        <?php for($i = 0; $i < $total; $i += $limit)
        {
            $current = (int)($i / $limit + 1);
            $list = $current == $page ? '<li class="active">' : '<li>';
            $list .= '<a href="/location/' . $model->id . '?page=' . $current . '">';
            $list .= $current;
            $list .= '</a>';
            $list .= '</li>';
            echo $list;
        } ?>
        <li class="next<?php if ($page == ceil($total / $limit)) echo ' disabled';?>">
            <?php if ($page < ceil($total / $limit))
            {
                echo '<a href="/location/' . $model->id . '?page=' . ($page + 1) . '">&raquo;</a>';
            }
            else
            {
                echo '<span>&raquo;</span>';
            }
            ?>
        </li>
    </ul>

</div>