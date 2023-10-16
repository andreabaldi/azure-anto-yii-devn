<?php

namespace frontend\controllers;


use frontend\models\Ospiti;
use frontend\models\OspitiTessera;
use frontend\models\OspitiTesseraSearch;
use frontend\models\Tessera;
use frontend\models\TesseraSearch;
use sjaakp\alphapager\ActiveDataProvider;
use Yii;
use yii\data\ArrayDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

use kartik\form\ActiveForm;
use frontend\models\Statoservizio;
use frontend\models\StatoservizioSearch;

const NO = 0;
const RINNOVO = 1;
const PERSA = 2;
const NUOVA = 3;

/**
 * Site controller
 */
class OtmController extends Controller
{



    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'except' => ['login', 'error'],
                'rules' => [
                    [
                        'actions' => [],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function  ddrk()
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




    /**
     * {@inheritdoc}
     */
    public function actionUpdate($id)
    {
     
        $ospite = Ospiti::findOne($id);
        if (!$ospite) {
            throw new NotFoundHttpException("Ospite non trovato.");
        }
        
        $tessera = Tessera::findOne($id );
        
        if (!$tessera) {
            throw new NotFoundHttpException("Tessere non trovata.");
        }
        
        
        if ($ospite->load(Yii::$app->request->post()) && $tessera->load(Yii::$app->request->post())) {
            $isValid = $ospite->validate();
            $isValid = $tessera->validate() && $isValid;
            if ($isValid) {
                $ospite->save();
                $tessera->save();
                Yii::$app->session->setFlash('success',"Ospite e tessera Salvati Correttamente");
                return $this->redirect(['otm/view', 'id' => $id]);
            }
        }
        
        return $this->render('update', [
            'ospite' => $ospite,
            'tessera' => $tessera,
        ]);
    }
 

 
 
/**
     * Displays a single Ospiti model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */


    /**
     * Displays a single Ospiti model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $ot = OspitiTessera::findOne($id);
        // echo $id;
        if (!$ot) {
            throw new NotFoundHttpException("Ospite non trovato.");
        }

        return $this->render('view', [
            'ot' => $ot,
        ]);
    }



 
/**
     * Displays homepage.
     *
     * @return Mixed
     */
    public function actionIndexa()
    {

    //Create a query builder object
    $qr = (new \yii\db\Query());
    //Compose  the  query using [[]] and {{}}


    $qr->select('[[Ospiti.id]],  
    [[Ospiti.nome]], 
    [[Ospiti.cognome]], 
    [[Ospiti.nascita]], 
    [[Ospiti.genere]], 
    [[Ospiti.nazionalita]], 
    [[Tessera.dataRilascio]], 
    [[Tessera.dataUltimoRinnovo]], 
    [[Tessera.dataScadenza]], 
    [[Tessera.printme]],
     [[Statoservizio.stato]],
    ')
    ->from('{{Ospiti}}')
    ->innerjoin('{{Statoservizio}} ON [[Ospiti.id]] = [[Statoservizio.id]] ')
    ->innerJoin('{{Tessera}}', '[[Ospiti.id]] = [[Tessera.id]]');
    $rows = $qr->all();

    $searchModel = new OspitiTesseraSearch();
    $dataprovider = $searchModel->search(\Yii::$app->request->get());
//    $dataprovider = new ArrayDataProvider([
//         'allModels' => $rows,
//         'sort' => [
//             'attributes' => ['id','cognome', 'nome', 'stato', 'nascita','genere', 'nazionalita' , 'dataRilascio', 'dataUltimoRinnovo', 'dataScadenza','printme'],
//         ],
//
//         'pagination' => [
//             'pageSize' => 10,
//         ],
//         ]);


             return $this->render('indexa',
                ['dataProvider' =>$dataprovider,
                'searchModel' => $searchModel,]
         );

}

     
    /**
     * Displays homepage.
     *
     * @return mixed
     */

        public function actionIndex()
        {
            $searchModel = new OspitiTesseraSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
            $dataProvider->pagination = ['pageSize' => 15];
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    /**
     * Displays homepage.
     *
     * @return mixed
     */

    public function actionIndexsave()
    {
        $searchModel = new OspitiTesseraSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->pagination = ['pageSize' => 15];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays homepage.
     *
     * @return mixed
     */
   
     public function actionTprint()
     {
         $searchModel = new OspitiTesseraSearch();
         $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
         $dataProvider->pagination = ['pageSize' => 0];
        

         return $this->render('tprint', [
             'searchModel' => $searchModel,
             'dataProvider' => $dataProvider,
         ]);
     }


     public function actionPrintme($id)
     {
        $tessera = Tessera::findOne($id);
        
        if (!$tessera) {
            throw new NotFoundHttpException("Tessera con ID:".$id." non esiste");
        }
        if ($tessera->printme == 1) $tessera->printme = 0;
        else $tessera->printme = 1;

        $tessera->save();
                Yii::$app->session->setFlash('success',"Ospite e Tessera Salvati");
                return $this->redirect(['otm/index']);
        
        // print ($id); 
     }





    public function actionPrintsel($id, $who)
    {
        $tessera = Tessera::findOne($id);


        if ($tessera->load(Yii::$app->request->post())) {
            $isValid = $tessera->validate();
            if ($isValid) {
                $tessera->save();
                Yii::$app->session->setFlash('success',"Opzione Stampa Tessera Salvata Correttamente");
                if ($who ==1)
                return $this->redirect(['otm/rilasciotessere']);
                else
                    return $this->redirect(['otm/index']);

            }
        }

        return $this->render('printselform', [
            'tessera' => $tessera
        ]);

    }



     
     public function actionListpres($id)
     {
        
        $qr = (new \yii\db\Query());
        $did= $id;
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
    
    


     public function actionBulk(){
        
       
        $selection=(array)Yii::$app->request->post('selection');
       // $selection = $('#abtable').yiiGridView('getSelectedRows');
        //$selection[0] = 0;
       //$selection[1]=2;
       //$selection[2]=3;
       //$selection[3]=18;
        
        
        
       echo "Selected IDs: ";
        print_r($selection);

    
        require_once(\Yii::getAlias('@vendor/tecnickcom/tcpdf/tessere/GenTesseraBpdf.php') );

        $doc = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $doc->AddPage('L',"A4");
        // Set positin for teh tessere
                $xpos = array(
                    0,
                    95,
                    190);
                $ypos = array(
                        0,
                        55,
                        110);
        $count = sizeof ($selection);
        //print ($count);
       while($count > 0){
            for($j = 0, $ysize = count($ypos); $j < $ysize && $count >0; ++$j) {

                for($i = 0, $xsize = count($xpos); $i < $xsize && $count >0; ++$i) {
                  //  $row = mysqli_fetch_array($result);
                --$count;
                $pos = sizeof ($selection) - $count -1;
                // pos is calculated to access the aray from the first position and have tessere printed in thew right order
                $model = OspitiTessera::findOne($selection[$pos]);
                //get data scadenza from the form 
                $d1 = Yii::$app->request->post('scadenza');

                if ($model->printme == RINNOVO) {//Rinnovo data di oggi +X mesi
                    $effectiveDate = strtotime("+".$d1." months", strtotime(date("Y-m-d")));
                    $dataScadenza = date("Y-m-d", $effectiveDate);
                 DisplayTessera($doc, $model->id,$model->nome,$model->cognome,$dataScadenza,$xpos[$i] ,$ypos[$j]);
                }
                elseif ( $model->printme == NUOVA) // Valore attuale DB
                    {
                    DisplayTessera($doc, $model->id,$model->nome,$model->cognome,$model->dataScadenza,$xpos[$i] ,$ypos[$j]);
                 }
                elseif ( $model->printme == PERSA or $model->printme == NO) // Valore attuale DB unless
                {
                    if ($model->dataScadenza <= date("Y-m-d"))

                        {
                            $effectiveDate = strtotime("+".$d1." months", strtotime(date("Y-m-d")));
                            $dataScadenza = date("Y-m-d", $effectiveDate);
                            DisplayTessera($doc, $model->id,$model->nome,$model->cognome,$dataScadenza,$xpos[$i] ,$ypos[$j]);
                        }
                     else DisplayTessera($doc, $model->id,$model->nome,$model->cognome,$model->dataScadenza,$xpos[$i] ,$ypos[$j]);
                }
            }
        } 
        if ($count >0) $doc->AddPage('L',"A4");
     }
            //to be changed  according to the installation
        $doc->Output('/var/www/html/anto-yii-devn/tessere/'.'TS-'.'print'.'.pdf', 'F');
          echo "Le tessere Sono state stampate ed il file e' disponibile per la stampa"."<br>";
          echo '<a href="http://wwa.northeurope.cloudapp.azure.com/anto-yii-devn/tessere/TS-print.pdf"  > Clicca per Aprire  </a>';


     }



     public function  inrange($sta,$sto)
     {
    $status = true;
         $lastid = OtmController::Newid()-1;
         if ($sta >$lastid || $sto > $lastid)  $status = false;
         if ($sta > $sto)$status = false;
         if ($sta == 0 || $sto  == 0)$status = false;
         if ($sta == '' || $sto  == '')$status = false;
         return $status;
     }


     public function actionSelcheck()
        {


        $proptions=Yii::$app->request->post('proptions');

            //set all to the specified value  
            if  (Yii::$app->request->post('submit') === 'selezionatutti')
            {
                $lastid = OtmController::Newid()-1;     
                   //  echo "OK all <br>".$lastid; 

                for($i = 1; $i <= $lastid ; ++$i){    
                    $model = Tessera::findOne($i);
                            $model->printme = $proptions;
                            $model->save();
                }
                return $this->redirect(['otm/tprint'])     ;     
            }
            if (Yii::$app->request->post('submit') === 'seleziona')  
             {
             $start=Yii::$app->request->post('start');
             $stop=Yii::$app->request->post('stop');
             $proptions=Yii::$app->request->post('proptions');
             $lastid = OtmController::Newid()-1;       

            if (OtmController::inrange($start,$stop))


            {
                for ($i = $start; $i <= $stop; ++$i) {
                    $model = Tessera::findOne($i);
                    $model->printme = $proptions;
                    $model->save();
                }
            }
                      else  Yii::$app->session->setFlash('warning'," Intervallo Non valido. Start: ".$start."  Stop: ".$stop);

            }


          return $this->redirect(['otm/tprint']);
         }

    
         public function actionSelall1()
        {
            $proptions=0;   
        if (Yii::$app->request->post('submit') === 'selezionatutti') 
             $proptions=Yii::$app->request->post('proptions'); 
           $lastid = OtmController::Newid()-1;      

         for($i = 1; $i <= $lastid ; ++$i){    
                $model = Tessera::findOne($i);
                     $model->printme = $proptions;
                     $model->save();
         }

           return $this->redirect(['otm/tprint']);
    }




    /**
     * Displays homepage.
     *
     * @return mixed
     */

    public function actionRilasciotessere1()
    {
        $searchModel = new OspitiTesseraSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('rilasciotessere', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }



    /**
     * Displays homepage.
     *
     * @return Mixed
     */
    public function actionRilasciotessere()
    {
    

    //Create a query builder object
    $qr = (new \yii\db\Query());
    //Compose  the  query using [[]] and {{}}


        // echo "(B)".$d1."     -    ". $d2;
        $ar = OtmController::ddrk();
        $ar = OtmController::ddrk();
        $d1 = $ar[0];
        $d2 = $ar[1];

    $qr->select('[[Ospiti.id]],  
    [[Ospiti.nome]], 
    [[Ospiti.cognome]], 
    [[Ospiti.nascita]], 
    [[Ospiti.genere]], 
    [[Ospiti.nazionalita]], 
    [[Tessera.dataRilascio]], 
    [[Tessera.dataUltimoRinnovo]], 
    [[Tessera.dataScadenza]], 
    [[Tessera.printme]],
    ')
    ->from('{{Ospiti}}')
    ->innerJoin('{{Tessera}}', '[[Ospiti.id]] = [[Tessera.id]]')
    ->where('[[Tessera.dataRilascio]]  BETWEEN :d1 AND :d2')
        ->addParams([':d1' => $d1." 00:00:00"])
        ->addParams([':d2' => $d2." 23:59:59"]);
//    ->limit(500);
 // build and execute the query made then available in rows
    $rows = $qr->all();



     $searchModel = new OspitiTesseraSearch();

    $dataProvider = new ArrayDataProvider([
         'allModels' => $rows,
         'sort' => [
             'attributes' => ['id','cognome', 'nome', 'nascita','genere', 'nazionalita' , 'dataRilascio', 'dataUltimoRinnovo', 'dataScadenza','printme'],
         ],

         'pagination' => [
             'pageSize' => 20,
         ],
         ]);
        $dataProvider = $searchModel->search($this->request->queryParams);
           
             return $this->render('rilasciotessere',
                ['dataProvider' =>$dataProvider,
                'searchModel' => $searchModel,
                    'd1' => $d1,
                    'd2' => $d2,
                    ]
         );

}


    public function actionCreate()
    {
     $id = OtmController::Newid();
        $ospite = Ospiti::findOne($id);
        if ($ospite) {
            throw new NotFoundHttpException("Ospite con ID:".$id." esiste gia");
        }
        
        $tessera = Tessera::findOne($id);
        
        if ($tessera) {
            throw new NotFoundHttpException("Tessera con ID:".$id." esiste gia");
        }
        $statoservizio = Tessera::findOne($id);

        if ($statoservizio) {
            throw new NotFoundHttpException("Stato Servizio con ID:".$id." esiste gia");
        }


        
        $ospite = new Ospiti();
        $ospite->id = $id;
        $ospite->nascita = "1901-01-01";
        $tessera = new Tessera();
        $tessera->id = $id;

        $tessera->dataRilascio = date("Y-m-d");
        $tessera->dataUltimoRinnovo = date("Y-m-d",);
        // Espire after 3 months
        $effectiveDate = strtotime("+6 months", strtotime(date("Y-m-d")));
        $tessera->dataScadenza = date("Y-m-d", $effectiveDate);
        $tessera->printme = false;

        $statoservizio = new Statoservizio();
        $statoservizio->id= $id;
        $statoservizio->stato= "NUOVO";
        $statoservizio->info= "In ACCETTAZIONE";

        if ($this->request->isPost) {
            if ($ospite->load($this->request->post())  && $tessera->load($this->request->post()))

            
            {
                $ospite->save();
                $tessera->save();
                $statoservizio->save();
                Yii::$app->session->setFlash('success',"Ospite e Tessera e Stato Salvati");
                return $this->redirect(['otm/view', 'id' => $tessera->id]);
            }           
            
        } else {
          //  Yii::$app->session->setFlash('success',"DEfault values");
            $ospite->loadDefaultValues();
            $tessera->loadDefaultValues();
            $statoservizio->loadDefaultValues();
        }


        return $this->render('create', [
            'ospite' => $ospite,
            'tessera' => $tessera,
        ]);
        
    }

    public function Newid()
    {

    //Create a query builder object
    $qr = (new \yii\db\Query());
    //Compose  the  query using [[]] and {{}}
    $qr->select('id')->from('{{Ospiti}}')
    ->where('id = (SELECT MAX(ID) FROM Ospiti)');
    $rows = $qr->all();   
    $id = $rows[0]['id'];
    echo $id;
   // echo "<br>";
   //print_r($rows);
    //var_dump($rows);
    return ($id + 1);

    }


    public function actionFoo()
    {

        
        return $this->render('foo');
        
    }
    


    public function actionPager()    {
        
        
        $query = OspitiTessera::find()->orderBy('Cognome');
       
        $dataProvider = new ActiveDataProvider([
            'query' => $query, 
            'alphaAttribute' => 'Cognome'
        ]);

        return $this->render('pager', [
            'dataProvider' => $dataProvider
        ]);
    }

    


     
}
