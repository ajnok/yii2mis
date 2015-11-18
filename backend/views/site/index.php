<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <?php
        echo("apiField: <br />");
        var_dump($apiField);
        echo("apiField: <br />");
        echo("<br /><br /><br />");
        var_dump($dbField);
        echo("<br /><br /><br />");
//        var_dump($insertedField);


    ?>

    <?php
    $array1 = array("a" => "green", "red", "blue");
    $array2 = array("b" => "green", "red", "blue");
    $result = array_diff($array1, $array2);
    print_r($result);
    ?>
</div>
