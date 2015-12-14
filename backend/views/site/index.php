<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
//use yii\grid\GridView;
use kartik\grid\GridView;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <?php
        $gridColumns = [
            [
//                ['class' => 'yii\grid\SerialColumn'],
                'field',
                'description',

            ]
        ];
//        echo GridView::widget([
//            'dataProvider' => $include,
//            'filterModel' => $searchModel,
//            'columns' => $gridColumns,
//        ]);
            echo GridView::widget([
                'dataProvider' => $include,
               'filterModel' => $include,

                'columns' => [
                    ['class' => 'kartik\grid\SerialColumn'],
    //                'id',
                    [
                        'class' => 'kartik\grid\DataColumn',
                        'attribute' => 'field',

                    ],
                    'description',
                    [
                        'class'=>'kartik\grid\BooleanColumn',
                        'attribute'=>'visibility',
                    ],
                    [
                        'class'=>'kartik\grid\BooleanColumn',
                        'attribute'=>'new',
                    ],
                    [
                        'class'=>'kartik\grid\EditableColumn',
                        'attribute'=>'inserted_at',
                        'hAlign'=>'center',
                        'vAlign'=>'middle',
                        'width'=>'9%',
                        'format'=>'date',
                        'xlFormat'=>"mmm\\-dd\\, \\-yyyy",
                        'headerOptions'=>['class'=>'kv-sticky-column'],
                        'contentOptions'=>['class'=>'kv-sticky-column'],
                        'readonly'=>function($include, $key, $index, $widget) {
                            return (!$include['visibility']); // do not allow editing of inactive records
                        },
                        'editableOptions'=>[
                            'header'=>'Publish Date',
                            'size'=>'md',
                            'inputType'=>\kartik\editable\Editable::INPUT_WIDGET,
                            'widgetClass'=> 'kartik\datecontrol\DateControl',
                            'options'=>[
                                'type'=>\kartik\datecontrol\DateControl::FORMAT_DATE,
                                'displayFormat'=>'dd.MM.yyyy',
                                'saveFormat'=>'php:Y-m-d',
                                'options'=>[
                                    'pluginOptions'=>[
                                        'autoclose'=>true
                                    ]
                                ]
                            ]
                        ],
                    ],
                    'inserted_at',
                    'renewed_at',


                ],
                'export' => false,
            ]);
    //        echo GridView::widget([
    //            'dataProvider' => $exclude,
    //                'filterModel' => $searchModel,
    //
    //            'columns' => [
    //                ['class' => 'yii\grid\SerialColumn'],
    ////                'id',
    //                'field',
    //                'description',
    //                'visibility',
    //                'new',
    //                'inserted_at',
    //                'excluded_at',
    //
    //
    //            ]
    //        ]);
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
