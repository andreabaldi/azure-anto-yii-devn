<?php

/** @var yii\web\View $this */
/** @var backend\models\Presenze $model */
 function av($mname, $dp) {
    $myAverage = 0;
    $myTot = 0;
    $myCnt = 0;
    $data = $dp->getModels();

    foreach ($data as $key => $value) {
        $myTot += $value[$mname];
        $myCnt++;
    }
    if ($myCnt > 0) {
        $myAverage = $myTot / $myCnt;
    }

    return ($myAverage);
}


function cmf( $dp) {

    $MM = 0;
    $FF = 0;
    $data = $dp->getModels();

    foreach ($data as $key => $value) {
        if ($value['genere'] === "M") $MM +=1;
        elseif ($value['genere'] === "F") $FF +=1;
    }
    return [$MM, $FF];
}

function cp( $dp) {

    $NN = 0;

    $data = $dp->getModels();

    foreach ($data as $key => $value) {
       $NN +=1;
    }
    return [$NN];
}