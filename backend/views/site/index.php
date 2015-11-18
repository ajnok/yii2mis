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
        var_dump($insertedField);
    ?>
</div>
