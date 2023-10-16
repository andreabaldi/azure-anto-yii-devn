<?php

namespace backend\controllers;
use backend\models\Presenze;
use backend\models\PresenzeSearch;
use sjaakp\datepager\ActiveDataProvider;
use Yii;
use yii\data\ArrayDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use function PHPUnit\Framework\returnArgument;

/**
 * PresenzeController implements the CRUD actions for Presenze model.
 */
class PresenzeController extends Controller
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
    public function actionIndex()
    {
        $searchModel = new PresenzeSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionPager()    {
        
        
        $query = Presenze::find()->orderBy('id');
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'dateAttribute' => 'entrata'
        ]);

        return $this->render('pager', [
            'dataProvider' => $dataProvider
        ]);
    }

    
    
    /**
     * Displays a single Presenze model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    
    /**
     * Creates a new Presenze model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Presenze();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Ospiti model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Presenze model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Presenze model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Presenzei the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Presenze::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionPresenzegiorno()
    {
    

    //Create a query builder object
    $qr = (new \yii\db\Query());
    //Compose  the  query using [[]] and {{}}


    $d1 = date('Y-m-d')." 23:59:59";

    $d2 = date('Y-m-d')." 00:00:00";

    $qr->select('[[Presenze.id]], 
    [[Presenze.entrata]], 
    [[Ospiti.nome]], 
    [[Ospiti.cognome]],',)
    ->from('{{Presenze}}')
    ->innerJoin('{{Ospiti}}', '[[Ospiti.id]] = [[Presenze.id]]')
            ->where('[[Presenze.entrata]]  BETWEEN :d2 AND :d1')
                  ->addParams([':d1' => $d1])
                       ->addParams([':d2' => $d2])
   // ->where('[[Presenze.entrata]]  BETWEEN "'.$d2.'" AND "'. $d1.'"')
    ->limit(1000);
 // buiold and executre the query made then avaiable in rows
    $rows = $qr->all();   

    $dataprovider = new ArrayDataProvider([
        // 'allModels' => $query->queryAll(),
         'allModels' => $rows,
         'sort' => [
             'attributes' => ['id','cognome', 'nome', 'entrata'],
         ],
         'pagination' => [
             'pageSize' => 0,
         ],
         ]);
     
         
             return $this->render('presenzegiorno',
                ['dataProvider' =>$dataprovider,]
         );

}
public function actionIdinfo($did)
    {
    
    $qr = (new \yii\db\Query());

    $qr->select('[[Presenze.id]], 
    [[Ospiti.nome]], 
    [[Ospiti.cognome]],[[Presenze.entrata]],',)
    ->from('{{Presenze}}')
    ->innerJoin('{{Ospiti}}','[[Ospiti.id]] = [[Presenze.id]]')
            ->where('[[Presenze.id]] =:did')
                  ->addParams([':did' => $did]);
                    
    $rows = $qr->all();  
    $dataprovider = new ArrayDataProvider([
         'allModels' => $rows,
         'sort' => [
             'attributes' => ['id','nome', 'cognome', 'entrata'],
         ],
         'pagination' => [
             'pageSize' =>0,
         ],
         ]);
         
             return $this->render('drilldown',
                ['dataProvider' =>$dataprovider,]
         );

}



/*()
     * Displays homepage.
     *
     * @return string
     */
    public function actionPanno()
    {

    //Create a query builder object
    $qr = (new \yii\db\Query());
    //Compose  the  query using [[]] and {{}}


    $d1 = date('Y-m-d')." 23:59:59";
        // Set D2 to the  Epoch of teh project 2022-03-07;
        $d2 = "2022-03-07"." 00:00:00";
    //$d2 = date('Y-m-d', strtotime($d1. ' - 365 days'))." 00:00:00";
    $qr->select('Year([[Presenze.entrata]]) AS Anno, COUNT([[Presenze.id]]) as Presenze, COUNT(DISTINCT [[Presenze.id]]) as Ospiti ')     
    ->from('{{Presenze}}')
    ->groupby('Year([[Presenze.entrata]])')
            ->where('[[Presenze.entrata]]  BETWEEN :d2 AND :d1')
                  ->addParams([':d1' => $d1])
                       ->addParams([':d2' => $d2])
   // ->where('[[Presenze.entrata]]  BETWEEN "'.$d2.'" AND "'. $d1.'"')
    ->limit(1000);
 // bui ld and executre the query made then avaiable in rows
    $rows = $qr->all();   

    $dataprovider = new ArrayDataProvider([
        // 'allModels' => $query->queryAll(),
         'allModels' => $rows,
         'sort' => [
             'attributes' => ['Anno','Presenze', 'Ospiti']         ],
         'pagination' => [
             'pageSize' => 25,
         ],
         ]);
     
         
             return $this->render('anno',
                ['dataProvider' =>$dataprovider,]
         );

}

/*()
     * Displays homepage.
     *
     * @return string
     */
    public function actionPtrimestri()
    {

    //Create a query builder object
    $qr = (new \yii\db\Query());
    //Compose  the  query using [[]] and {{}}

    $d1 = date('Y-m-d')." 23:59:59";
        $d2 = "2022-03-07"." 00:00:00";
//    $d2 = date('Y-m-d', strtotime($d1. ' - 365 days'))." 00:00:00";

    $qr->select('Year([[Presenze.entrata]]) AS Anno, QUARTER([[Presenze.entrata]]) AS Trimestre, COUNT([[Presenze.id]]) as Presenze, COUNT(DISTINCT [[Presenze.id]]) as Ospiti ')
    ->from('{{Presenze}}')
    ->groupby('Year([[Presenze.entrata]]),QUARTER([[Presenze.entrata]])')
     ->orderby('Year([[Presenze.entrata]]),QUARTER([[Presenze.entrata]])')
            ->where('[[Presenze.entrata]]  BETWEEN :d2 AND :d1')
                  ->addParams([':d1' => $d1])
                       ->addParams([':d2' => $d2])
   // ->where('[[Presenze.entrata]]  BETWEEN "'.$d2.'" AND "'. $d1.'"')
    ->limit(1000);
 // bui ld and executre the query made then avaiable in rows
    $rows = $qr->all();   

    $dataprovider = new ArrayDataProvider([
        // 'allModels' => $query->queryAll(),
         'allModels' => $rows,
         'sort' => [
             'attributes' => ['Anno', 'Trimestre','Presenze', 'Ospiti']         ],
         'pagination' => [
             'pageSize' => 25,
         ],
         ]);
     
         
             return $this->render('trimestre',
                ['dataProvider' =>$dataprovider,]
         );

}
/*
     * Displays homepage.
     *
     * @return string
     */
    public function actionPmesi()
    {

    //Create a query builder object
    $qr = (new \yii\db\Query());
    //Compose  the  query using [[]] and {{}}


    $d1 = date('Y-m-d')." 23:59:59";
    // Set D2 to the  Epoch of teh project 2022-03-07;
        $d2 = "2022-03-07"." 00:00:00";
//    $d2 = date('Y-m-d', strtotime($d1. ' - 365 days'))." 00:00:00";

    $qr->select('Year([[Presenze.entrata]]) AS Anno, MONTH([[Presenze.entrata]]) AS Mese, COUNT([[Presenze.id]]) as Presenze, COUNT(DISTINCT [[Presenze.id]]) as Ospiti ')
    ->from('{{Presenze}}')
    ->groupby('Year([[Presenze.entrata]]), MONTH([[Presenze.entrata]])')
     ->orderby('Year([[Presenze.entrata]]), MONTH([[Presenze.entrata]])')
    //->where('[[Presenze.entrata]]  BETWEEN "'.$d2.'" AND "'. $d1.'"')
              ->where('[[Presenze.entrata]]  BETWEEN :d2 AND :d1')
                  ->addParams([':d1' => $d1])
                       ->addParams([':d2' => $d2])
    ->limit(1000);
 // bui ld and executre the query made then avaiable in rows
    $rows = $qr->all();   

    $dataprovider = new ArrayDataProvider([
        // 'allModels' => $query->queryAll(),
         'allModels' => $rows,
         'sort' => [
             'attributes' => ['Anno','Mese','Presenze', 'Ospiti']],
         'pagination' => [
             'pageSize' => 25,
         ],
         ]);

         
             return $this->render('mesi',
                ['dataProvider' =>$dataprovider,
                    ]
         );

}


/*
     * Displays homepage.
     *
     * @return Array
     */
    public function actionPcount()
    {

    //Create a query builder object
    $qr = (new \yii\db\Query());

        // echo "(B)".$d1."     -    ". $d2;
        $ar = PresenzeController::ddrk();
        $d1 =  $ar[0];
        $d2 =  $ar[1];

    $qr->select('[[Ospiti.id]], 
    [[Ospiti.nome]], 
    [[Ospiti.cognome]],
    COUNT([[Presenze.id]]) as Presenze,
    ',)
    ->from('{{Ospiti}}')
    ->leftjoin('{{Presenze}}', '[[Ospiti.id]] = [[Presenze.id]]')
    ->groupby('[[Ospiti.id]], [[Ospiti.nome]],[[Ospiti.cognome]]')
                  ->where('[[Presenze.entrata]]  BETWEEN :d1 AND :d2')
        ->addParams([':d1' => $d1." 00:00:00"])
        ->addParams([':d2' => $d2." 23:59:59"])
    ->orderby(['Presenze'=> SORT_DESC]);
 // bui ld and executre the query made then avaiable in rows
    $rows = $qr->all();   

    $dataprovider = new ArrayDataProvider([
        // 'allModels' => $query->queryAll(),
         'allModels' => $rows,
         'sort' => [
             'attributes' => ['id','nome', 'cognome','Presenze']         ],
         'pagination' => [
             'pageSize' => 0,
         ],
         ]);


        return $this->render('countpres',
            ['dataProvider' =>$dataprovider,
                'd1' => $d1,
                'd2' => $d2,
            ]
        );

}


/*
     * Displays homepage.
     *
     * @return string
     */
    public function actionPresenzek()
    {


      //  echo "(A)".$d1."     -    ". $d2. "   ";

        $qr = (new \yii\db\Query());
        $ar = PresenzeController::ddrk();
        $d1 =  $ar[0];
        $d2 =  $ar[1];

       $qr->select('[[Ospiti.id]], 
             [[Ospiti.cognome]],
             [[Ospiti.nome]],
             COUNT([[Presenze.id]]) AS TotPres')
                ->from('{{Ospiti}}')
               ->leftjoin('{{Presenze}} ON [[Ospiti.id]] = [[Presenze.id]] ')
               ->groupby('[[Ospiti.id]], 
                [[Ospiti.Cognome]], 
                [[Ospiti.nome]] ')
           ->where('[[Presenze.entrata]]  BETWEEN :d1 AND :d2')
           ->addParams([':d1' => $d1])
           ->addParams([':d2' => $d2])
               ->orderby('TotPres DESC')
               ->limit ('500');

      $rows = $qr->all();

    $dataprovider = new ArrayDataProvider([
        // 'allModels' => $query->queryAll(),
         'allModels' => $rows,
         'sort' => [
             'attributes' => ['PresEnt','TopPres']         ],
         'pagination' => [
             'pageSize' => 15,
         ],
         ]);


             return $this->render('totpresk',
                ['dataProvider' =>$dataprovider,
                    'd1' => $d1,
                    'd2' => $d2,
                    ]
         );


    }



    public function  ddrk($dl='1')
    {

        //calcutaing  dates for querying default of last month
        $def1 = date('Y-m-d');
        $def2 = date('Y-m-d', strtotime($def1. ' - '.$dl.'months'));

        $d1=Yii::$app->request->post('datetime_min');
        $d2=Yii::$app->request->post('datetime_max');
        // echo "(A)".$d1."     -    ". $d2. "   ";
        $d1=!empty($_POST['datetime_min'])?$_POST['datetime_min']:$def2;
        $d2=!empty($_POST['datetime_max'])?$_POST['datetime_max']:$def1;
        //$d2= $d2." 23:59:59";
        //$d1= $d1." 00:00:00";
        return ([$d1, $d2]);

    }
    public function  ddr()
    {

        //calcutaing  dates for querying default of last month
        $def1 = date('Y-m-d');
        $def2 = date('Y-m-d', strtotime($def1. ' - 1 months'));

        $d1=Yii::$app->request->post('from_date');
        $d2=Yii::$app->request->post('to_date');
        // echo "(A)".$d1."     -    ". $d2. "   ";
        $d1=!empty($_POST['from_date'])?$_POST['from_date']:$def2;
        $d2=!empty($_POST['to_date'])?$_POST['to_date']:$def1;
        $d2= $d2." 23:59:59";
        $d1= $d1." 00:00:00";
        return ([$d1, $d2]);

    }


    /*
         * Displays homepage.
         *
         * @return string
         */
    public function actionMaxpresenze()
    {

        $limite = 30;
        if (Yii::$app->request->post()) { 
            if (Yii::$app->request->post('limite')) {
                $limite = !empty($_POST['limite']) ? $_POST['limite'] : $limite;
            }

        }
    $qr = (new \yii\db\Query());

        $ar = PresenzeController::ddrk();
        $d1 = $ar[0];
        $d2 = $ar[1];

// echo "(B)".$d1."     -    ". $d2;
       $qr->select('[[Ospiti.id]], 
             [[Ospiti.cognome]],
             [[Ospiti.nome]],
             COUNT([[Presenze.id]]) AS TotPres')
                ->from('{{Ospiti}}')
               ->leftjoin('{{Presenze}} ON [[Ospiti.id]] = [[Presenze.id]] ')
               ->groupby('[[Ospiti.id]], 
                [[Ospiti.Cognome]], 
                [[Ospiti.nome]] ')
               ->where('[[Presenze.entrata]]  BETWEEN :d1 AND :d2')
                ->addParams([':d1' => $d1." 00:00:00"])
                ->addParams([':d2' => $d2." 23:59:59"])
               ->orderby('TotPres DESC')
               ->limit($limite);

      $rows = $qr->all();

    $dataprovider = new ArrayDataProvider([
        // 'allModels' => $query->queryAll(),
         'allModels' => $rows,
         'sort' => [
             'attributes' => ['PresEnt','TopPres']         ],
         'pagination' => [
             'pageSize' => 0,
         ],
         ]);


             return $this->render('maxpres',
                ['dataProvider' =>$dataprovider,
                    'd1' => $d1,
                    'd2' => $d2,
                    'limite' => $limite,
                    ]
         );


    }



     public function actionPresenzedp()
     {

         $searchModel = new PresenzeSearcht();

         $dataProvider = $searchModel->search($this->request->queryParams);
         return $this->render('totpresdp', [
             'searchModel' => $searchModel,
             'dataProvider' => $dataProvider,
         'pagination' => [
             'pageSize' => 0],
         ]);
     }


     public function actionPresenze1()
     {

         $searchModel = new PresenzeSearcht();
         $dataProvider = $searchModel->search($this->request->queryParams);

         return $this->render('totpresdp', [
             'searchModel' => $searchModel,
             'dataProvider' => $dataProvider,
         ]);
     }




/*
/*
     * Displays homepage.
     *
     * @return string
     */
    public function actionNazioni()
    {

    $qr = (new \yii\db\Query());

       $qr->select('COUNT(*) as CountC,  [[Ospiti.nazionalita]], ')
                ->from('{{Ospiti}}')
               ->groupby('[[Ospiti.nazionalita]] HAVING  COUNT(*) > 0 ')
               ->orderby('CountC DESC');

      $rows = $qr->all();

    $dataprovider = new ArrayDataProvider([
        // 'allModels' => $query->queryAll(),
         'allModels' => $rows,
         'sort' => [
             'attributes' => ['CountC','nazionalita']],
         'pagination' => [
             'pageSize' => 0,
         ],
         ]);


             return $this->render('ospitibyreg',
                ['dataProvider' =>$dataprovider,]
         );


    }

    public function actionEtamedia()
    {
        $qr = (new \yii\db\Query());

        $query = (new \yii\db\Query())
        ->select(' COUNT(*) as No, CEIL(AVG(eta)) as em ,naz as NA
        FROM 
        (SELECT * FROM (SELECT `Ospiti`.`nazionalita` as naz , CEIL((DATEDIFF(NOW(), `Ospiti`.`nascita` )/365)) AS `eta` FROM `Ospiti` HAVING eta>= 18 and eta < 100 ORDER BY `naz`)as T WHERE 1) 
         as V
         GROUP by NA');
    
    $rows = $query->all();
// print_r($rows);
        $dataprovider = new ArrayDataProvider([
            // 'allModels' => $query->queryAll(),
             'allModels' => $rows,
             'sort' => [
                 'attributes' => ['No', 'em','NA']],
             'pagination' => [
                 'pageSize' => 0,
             ],
             ]);
    
    
                 return $this->render('etamedia',
                    ['dataProvider' =>$dataprovider,]
             );

    }

        public function actionPeriodo()
    {

        // echo "(B)".$d1."     -    ". $d2;
        $ar = PresenzeController::ddrk();
        $d1 = $ar[0];
        $d2 = $ar[1];

        $qr = (new \yii\db\Query());

        $qr->select('Year([[Presenze.entrata]]) AS Anno, MONTH([[Presenze.entrata]]) as Mese, COUNT([[Presenze.id]]) as Presenze, COUNT(DISTINCT [[Presenze.id]]) as Ospiti ')
            ->from('{{Presenze}}')
            ->where('[[Presenze.entrata]]  BETWEEN :d1 AND :d2')
            ->addParams([':d1' => $d1." 00:00:00"])
            ->addParams([':d2' => $d2." 23:59:59"])
            ->groupby('Year([[Presenze.entrata]]), MONTH([[Presenze.entrata]])')
            ->orderby('Year([[Presenze.entrata]]), MONTH([[Presenze.entrata]])')
            ->limit(1000);
        // bui ld and executre the query made then avaiable in rows
        $rows = $qr->all();

        $dataprovider = new ArrayDataProvider([
            // 'allModels' => $query->queryAll(),
            'allModels' => $rows,
            'sort' => [
                'attributes' => ['Presenze', 'Ospiti']         ],
            'pagination' => [
                'pageSize' => 0,
            ],
        ]);
        return $this->render('periodo',
            ['dataProvider' =>$dataprovider,
                'd1' => $d1,
                'd2' => $d2,
            ]
        );


    }


    public function actionIdlistaperiodo()
    {

        // echo "(B)".$d1."     -    ". $d2;
        $ar = PresenzeController::ddrk();
        $d1 = $ar[0];
        $d2 = $ar[1];

        $qr = (new \yii\db\Query());

        $qr->select('[[Presenze.id]], [[Ospiti.nome]],  [[Ospiti.cognome]], [[Ospiti.genere]], [[Ospiti.nazionalita]]')
            ->from('{{Presenze}}')
            ->leftjoin('{{Ospiti}} ON [[Ospiti.id]] = [[Presenze.id]] ')
           ->andwhere('[[Presenze.entrata]]  BETWEEN :d1 AND :d2')
           ->andwhere('[[Presenze.id]]  NOT IN (SELECT  {{m2}}.`ID`  FROM  {{Presenze}} {{m2}} WHERE {{m2}}.`entrata` < {{Presenze}}.`entrata`) ')
            ->addParams([':d1' => $d1." 00:00:00"])
            ->addParams([':d2' => $d2." 23:59:59"])
           ->groupby('[[Presenze.id]]')
           ->orderby('[[Presenze.id]]')
            ->limit(1000);
        // bui ld and executre the query made then avaiable in rows
        $rows = $qr->all();

        $dataprovider = new ArrayDataProvider([
            // 'allModels' => $query->queryAll(),
            'allModels' => $rows,
            'sort' => [
                'attributes' => ['id', 'nome', 'cognome','genere','nazionalita']   ],
            'pagination' => [
                'pageSize' => 0,
            ],
        ]);


        return $this->render('idlistaperiodo',
            ['dataProvider' =>$dataprovider,
                'd1' => $d1,
                'd2' => $d2,
            ]
        );


    }



    public function actionIdcountperiodo()
    {

        // echo "(B)".$d1."     -    ". $d2;
        $ar = PresenzeController::ddrk();
        $d1 = $ar[0];
        $d2 = $ar[1];

        $qr = (new \yii\db\Query());

        $qr->select('Year([[Presenze.entrata]]) AS Anno, MONTH([[Presenze.entrata]]) AS Mese,  COUNT(DISTINCT [[Presenze.id]]) as NuoviOspiti ')
            ->from('{{Presenze}}')
            ->andwhere('[[Presenze.entrata]]  BETWEEN :d1 AND :d2')
            ->andwhere('[[Presenze.id]]  NOT IN (SELECT  {{m2}}.`ID`  FROM  {{Presenze}} {{m2}} WHERE {{m2}}.`entrata` < {{Presenze}}.`entrata`) ')
            ->addParams([':d1' => $d1." 00:00:00"])
            ->addParams([':d2' => $d2." 23:59:59"])
            ->groupby('Year([[Presenze.entrata]]), MONTH([[Presenze.entrata]])')
            ->orderby('Year([[Presenze.entrata]]), MONTH([[Presenze.entrata]])')
            ->limit(1000);
        // bui ld and executre the query made then avaiable in rows
        $rows = $qr->all();

        $dataprovider = new ArrayDataProvider([
            // 'allModels' => $query->queryAll(),
            'allModels' => $rows,
            'sort' => [
                'attributes' => ['id', 'nome', 'cognome', 'genere']],
            'pagination' => [
                'pageSize' => 0,
            ],
        ]);


        return $this->render('idcountperiodo',
            ['dataProvider' => $dataprovider,
                'd1' => $d1,
                'd2' => $d2,
            ]
        );

    }


    public function actionPtotali()
    {

        // echo "(B)".$d1."     -    ". $d2;
        $ar = PresenzeController::ddrk();
        $d1 = $ar[0];
        $d2 = $ar[1];

        $qr = (new \yii\db\Query());

        $qr->select('Date([[Presenze.entrata]]) AS PresEnt, COUNT(Date([[Presenze.entrata]])) as TotPres ')
            ->from('{{Presenze}}')
            ->andwhere('[[Presenze.entrata]]  BETWEEN :d1 AND :d2')
            ->addParams([':d1' => $d1." 00:00:00"])
            ->addParams([':d2' => $d2." 23:59:59"])
            ->groupby('Date([[Presenze.entrata]])')
            ->limit(1000);
        // bui ld and executre the query made then avaiable in rows
        $rows = $qr->all();

        $dataprovider = new ArrayDataProvider([
            // 'allModels' => $query->queryAll(),
            'allModels' => $rows,
            'sort' => [
                'attributes' => ['PresEnt', 'ToPres']],
            'pagination' => [
                'pageSize' => 0,
            ],
        ]);


        return $this->render('totaliperiodo',
            ['dataProvider' => $dataprovider,
                'd1' => $d1,
                'd2' => $d2,
            ]
        );

    }


/*
     * Displays homepage.
     *
     * @return Array
     */
    public function actionPresenzeplus()
    {

    $limite =0; 
        if (Yii::$app->request->post()) {
            if (Yii::$app->request->post('limite')) {
                $limite = !empty($_POST['limite']) ? $_POST['limite'] :  $limite ;
            }
        }
    //Create a query builder object
    $qr = (new \yii\db\Query());

        // echo "(B)".$d1."     -    ". $d2;
        $ar = PresenzeController::ddrk('12');
        $d1 =  $ar[0];
        $d2 =  $ar[1];

    $qr->select('[[Ospiti.id]], 
    [[Ospiti.nome]], 
    [[Ospiti.cognome]],
    [[Ospiti.genere]],
    [[Ospiti.nazionalita]],
    [[Ospiti.nascita]],
    COUNT([[Presenze.id]]) as Presenze,',)
    ->from('{{Ospiti}}')
    ->leftjoin('{{Presenze}}', '[[Ospiti.id]] = [[Presenze.id]]')
    ->groupby('[[Ospiti.id]], [[Ospiti.nome]],[[Ospiti.cognome]]')
                  ->where('[[Presenze.entrata]]  BETWEEN :d1 AND :d2')
        ->addParams([':d1' => $d1." 00:00:00"])
        ->addParams([':d2' => $d2." 23:59:59"])
    ->orderby(['Presenze'=> SORT_DESC])
    ->having(['>=' , 'COUNT([[Presenze.id]])', $limite])
    ->limit(3000);
 // bui ld and executre the query made then avaiable in rows
    $rows = $qr->all();   

    $dataprovider = new ArrayDataProvider([
        // 'allModels' => $query->queryAll(),
         'allModels' => $rows,
         'sort' => [
             'attributes' => ['id', 'cognome', 'nome', 'genere', 'nazionalita', 'nascita','Presenze'] ],
         'pagination' => [
             'pageSize' => 0,
         ],
         ]);


        return $this->render('presenzeplus',
            ['dataProvider' =>$dataprovider,
                'd1' => $d1,
                'd2' => $d2,
                'limite' => $limite,
            ]
        );

}

    /**
     * Displays homepage.
     *
     * @return Mixed
     */
    public function actionPie()
    {


        //Create a query builder object
        $qr = (new \yii\db\Query());
        //Compose  the  query using [[]] and {{}}

        $qr->select('COUNT(*) as CountC, [[Ospiti.genere]]')
            ->from('{{Ospiti}}')
            ->groupby('[[Ospiti.genere]]')
            ->orderBy(['CountC' => SORT_DESC]);
        $rows = $qr->all();
        $dataprovider = new ArrayDataProvider([
            // 'allModels' => $query->queryAll(),
            'allModels' => $rows,
            //'filterModel' => $searchModel,
            'sort' => [
                'attributes' => ['CountC','genere'],
            ],
        ]);

        return $this->render('pie',
            ['dataProvider' =>$dataprovider]
        );

    }

    public function actionRapporto()
    {
        $this->layout = 'mainreport';

//        $report = new \backend\reports\TotPres;
        $report = new \backend\reports\TotPres(["d1"=>"2023-02-01", "d2"=>"2023-02-28"]);
        $report->run();
        return $this->render('rapporto',array(
            "rapporto"=>$report,

        ));

    }


    public function actionReport()
    {

        $this->layout = 'mainreport';
        $report = new \backend\reports\MyReport;
        $report->run();
        return $this->render('report',array(
            "report"=>$report
        ));

    }


}


