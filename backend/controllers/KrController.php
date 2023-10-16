<?php

namespace backend\controllers;
use frontend\controllers\Presenzei;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;


/**
 * Kool Report Controller for managing Time range GUI
 */
class KrController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Presenze models.
     *
     * @return string
     */
    public function actionKoolrep()
    {
        $ar = KrController::ddrk();
        $d1 = $ar[0];
        $d2 = $ar[1];
        $this->layout = 'mainreport';
        print_r($ar);
        $report = new \backend\reports\TotPres;
        $report->run();

        return $this->render('rapporto',
            ['rapporto' =>$report,
                'd1' => $d1,
                'd2' => $d2,
            ]);
//        return $this->render('rapporto',array(
//            "rapporto"=>$report
//        ));
    }
    public function ddrk()
    {

        //calcutaing  dates for querying default of last month
        $def1 = date('Y-m-d');
        $def2 = date('Y-m-d', strtotime($def1 . ' - 1 months'));

        $d1 = Yii::$app->request->post('datetime_min');
        $d2 = Yii::$app->request->post('datetime_max');
        // echo "(A)".$d1."     -    ". $d2. "   ";
        $d1 = !empty($_POST['datetime_min']) ? $_POST['datetime_min'] : $def2;
        $d2 = !empty($_POST['datetime_max']) ? $_POST['datetime_max'] : $def1;
        //$d2= $d2." 23:59:59";
        //$d1= $d1." 00:00:00";
        return ([$d1, $d2]);
    }
}