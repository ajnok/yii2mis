<?php

use yii\helpers\Html;
use yii\grid\GridView;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <?php

        echo GridView::widget([
            'dataProvider' => $include,
            'filterModel' => $searchModel,

            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
//                'id',
                'field',
                'description',
                'visibility',
                'new',
                'inserted_at',
                'renewed_at',


            ]
        ]);
        echo GridView::widget([
            'dataProvider' => $exclude,
                'filterModel' => $searchModel,

            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
//                'id',
                'field',
                'description',
                'visibility',
                'new',
                'inserted_at',
                'excluded_at',


            ]
        ]);
        //echo var_dump($dbField);
//        $dbField = array_filter($dbField,function($ar){
//           return ((int)$ar['excluded'] === 1 );
//        });
//        echo "<pre>";
//        print_r($dbField);
//        echo "<pre>";
//        print_r($include);
//        echo "<pre>";
//        print_r($exclude);

    ?>

    <?php
//    $arr = array(0 => array("id"=>1,"name"=>"cat 1"),
//        1 => array("id"=>2,"name"=>"cat 2"),
//        2 => array("id"=>3,"name"=>"cat 1")
//    );
//    $arr = array_filter($arr, function($ar) {
//        return ($ar['name'] == 'cat 1');
//        //return ($ar['name'] == 'cat 1' AND $ar['id'] == '3');// you can add multiple conditions
//    });
//
//    echo "<pre>";
//    print_r($arr);

    ?>
</div>
