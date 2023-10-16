<?php

/** @var yii\web\View $this */
/** @var frontend\models\barcode $model */


function lid( $dp)
{

    $data = $dp->getModels();

    foreach ($data as $key => $value) {
        return [$value['id']];
    }

}