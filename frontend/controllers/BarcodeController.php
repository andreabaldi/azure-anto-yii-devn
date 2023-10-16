<?php

namespace frontend\controllers;

use frontend\models\Barcode;
use frontend\models\BarcodeSearch;
use frontend\models\OspitiSearch;
use frontend\models\TesseraSearch;
use frontend\models\StatoservizioSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ArrayDataProvider;
use Yii;


/**
 * BarcodeController implements the CRUD actions for Barcode model.
 */
class BarcodeController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
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


    public function actionNa($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['barcode/indexe']);
    }


    /**
     * Lists all Barcode models.
     *
     * @return string
     */
    public function actionExport()
    {

        $searchModel = new BarcodeSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->pagination = ['pageSize' => 0];
        return $this->render('export', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'pagination' => [
                'pageSize' => 0,
            ],
        ]);
    }

    public function actionIndex()
    {

        $searchModel = new BarcodeSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->pagination = ['pageSize' => 0];
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'sort' => [
                'attributes' => ['id', 'entrance'],
            ],
            // no pagination for the tessera reader
            'pagination' => [
                'pageSize' => 0,
            ],
        ]);
    }



    
    /**
     * Lists all Barcode models.
     *
     * @return string
     */
    public function actionIndexe($page=null)
    {

        //Create a query builder object
        $qr = (new \yii\db\Query());
        //Compose  the  query using [[]] and {{}} and  accessing teh Barcode table and the Statoservizio

        $qr->select('[[barcode.id]], [[barcode.entrance]], 
        [[Tessera.dataScadenza]] ,
        [[Tessera.dataUltimoRinnovo]] ,
        [[Ospiti.nascita]] ,
        [[Ospiti.nazionalita]] ,
        [[Ospiti.genere]] ,
        [[Statoservizio.stato]]')
            ->from('{{barcode}}')
            ->leftjoin('{{Tessera}} ON [[barcode.id]] = [[Tessera.id]] ')
            ->leftjoin('{{Ospiti}} ON [[barcode.id]] = [[Ospiti.id]] ')
            ->leftjoin('{{Statoservizio}} ON [[barcode.id]] = [[Statoservizio.id]] ')

              ->orderby('[[barcode.entrance]] DESC ;');

        $rows = $qr->all();
        $params = [];
        //$searchModel = new BarcodeSearch();
        $pagination = BarcodeController::getPagination($params);
        $dataProvider = new ArrayDataProvider([
            'allModels' => $rows,
            'sort' => [
                'attributes' => ['id', 'stato','entrance', 'dataScadenza'],
            ],
            'pagination' => $pagination,

//            'pagination' => [
//                // Here we speficied if we want the pager. To exclude set it to 0;
//               'pageSize' => 8,
//            ],
        ]);
       // var_dump($dataProvider->pagination->currentPage);
        
        return $this->render('indexe', [
            //'searchModel' => $searchModel,
            'dataProvider' => $dataProvider]);

    }

    public function actionBulk()
    {
        $action = Yii::$app->request->post('action');
        echo "input : " . $input . "<br>";

        print_r($input);
    }


    /**
     * Displays a single Barcode model.
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

    public function actionSearch()
    {

        $searchModel = new BarcodeSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        return $this->render('_search', ['model' => $searchModel]);
    }


    /**
     * Creates a new Barcode model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Barcode();

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


    public function actionInsert()

    {
        $model = new Barcode();

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
     * Updates an existing Barcode model.
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
     * Deletes an existing Barcode model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['barcode/indexe']);
    }


    /**
     * Info for existing Barcode model.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionInfo  ($id)
    {

        $status= StatoservizioSearch::findOne($id);
        //check the  option to get the data from teh model and write on a success Flash

        if(!empty($status) &&  $status->stato == 'ATTIVO')
            Yii::$app->session->setFlash('info'," L'ospite: ".$id." e' in stato ".$status->stato." - Annotazioni: ".$status->info);
        elseif(!empty($status) &&  $status->stato == 'NUOVO')
            Yii::$app->session->setFlash('warning',"L'ospite ".$id." e' in stato ".$status->stato." - Annotazioni: ".$status->info);
        elseif(!empty($status) &&  $status->stato == 'SOSPESO')
            Yii::$app->session->setFlash('warning'," L'ospite: ".$id." e' in stato ".$status->stato." Dal: ".$status->sospesoDa." Al: ".$status->sospesoAl." - Annotazioni: ".$status->info);
                    elseif(!empty($status) &&  $status->stato == 'DECEDUTO')
            Yii::$app->session->setFlash('danger'," L'ospite: ".$id." e' in stato ".$status->stato." Il: ".$status->sospesoDa." - Annotazioni: ".$status->info);
                else
                    Yii::$app->session->setFlash('danger'," L'ospite: ".$id." e' in stato ".$status->stato." - Annotazioni: ".$status->info);
            return $this->redirect(['barcode/indexe']);
    }

    public function actionListpres ($id)
    {
    // this code is duplicated from otm controller, but I could not manage to call the controller action
    //     via Yii::$app->runAction('otm/listpres', ['id' => $id]);
        //// to be fixed in V2.1

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

    public function actionTessera($id)
    {


        $status= TesseraSearch::findOne($id);
        //check the  option to get the data from teh model and write on a success Flash
        if(!empty($status)) {
            if ($status->dataScadenza < date("Y-m-d"))
                Yii::$app->session->setFlash('error', "Tessera N.:". $id." Scaduta :".$status->dataScadenza . " " .". Ultimo Rinnovo :".$status->dataUltimoRinnovo." ");
            else Yii::$app->session->setFlash('success', "Tessera N.:". $id." in scadenza :".$status->dataScadenza . " " .". Ultimo Rinnovo :".$status->dataUltimoRinnovo." ");
        }
        else
            Yii::$app->session->setFlash('warning',"Tessera: ".$id." non trovato");
        return $this->redirect(['barcode/indexe']);

    }

    /**
     * id for existing Barcode model.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionId($id)
    {


        $status= OspitiSearch::findOne($id);
        //check the  option to get the data from teh model and write on a success Flash



        if(!empty($status)) {
            if ( !strcmp($status->nascita, "1900-01-01")
                || !strcmp($status->nazionalita,  "SCONOSCIUTA")
                || !strcmp($status->genere,  "X"))
            Yii::$app->session->setFlash('error', "Ospite N.:".$id. " :".$status->cognome . " " . $status->nome." (".
                $status->nascita." - ".$status->genere." - ". $status->nazionalita." )");
            else
               Yii::$app->session->setFlash('success', "Ospite N.:".$id. " :".$status->cognome . " " . $status->nome." (".
                $status->nascita." - ".$status->genere." - ". $status->nazionalita." )");
        }
        else
            Yii::$app->session->setFlash('warning',"Ospite: ".$id." non trovato");
        return $this->redirect(['barcode/indexe']);
    }


    public function actionBar()
    {
        // some stuff you handle
        return [
            'success'  => true,
            'growl' => [
                'title' => '<h3>Success!</h3>',
                'message' => '<p>Some message</p>',
                'type' => 'success',
                // other params
            ],
        ];
    }


    /**
     * Finds the Barcode model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Barcode the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Barcode::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    public function actionInput()
    {

        $barco = Yii::$app->request->post('barco');
        // printinfo_r($barco);

        $barco = !empty($_POST['barco']) ? $_POST['barco'] : "XXXX'";
        $barco = trim($_POST["barco"], " \n\r\t\v");
        $v = BarcodeController::parseinput($barco);
        if ($v != -1) {
            $model = new Barcode();
            $model->id = $v;
            $model->entrance = date("Y-m-d h:i:s");
            $model->save();
        }

        return $this->redirect(['indexe']);

    }

    // The following action is used from teh backend interface by clicking on the + sign
    public function actionInputbe($id)
    {
        $v = BarcodeController::parseinput($id);
        if ($v != -1) {
            $model = new Barcode();
            $model->id = $v;
            $model->entrance = date("Y-m-d h:i:s");
            $model->save();
        }

        return $this->redirect(['indexe']);
    }

    public function actionManage()
    {
        if ($barco = Yii::$app->request->post()) {
            //  print_r($barco );
            if (Yii::$app->request->post('submit') === 'carica') {
                $mysql = "INSERT IGNORE INTO Presenze (entrata, id) SELECT barcode.entrance , barcode.id FROM barcode WHERE 1;";
                Yii::$app->db->createCommand($mysql)
                    ->execute();
            } elseif (Yii::$app->request->post('submit') === 'rimuovi') {
                $mysql = "DELETE FROM barcode WHERE 1";
                Yii::$app->db->createCommand($mysql)
                    ->execute();

            } elseif (Yii::$app->request->post('submit') === 'chiudisessionepranzo') {
// Extract the presence and email to the administrator  the table t
                $mysql = "SELECT * FROM `barcode` WHERE 1;";
                Yii::$app->db->createCommand($mysql)
                    ->execute();

                $mysql = "INSERT INTO Presenze (entrata, id) SELECT barcode.entrance , barcode.id FROM barcode WHERE 1;";
                Yii::$app->db->createCommand($mysql)
                    ->execute();
                $mysql = "DELETE FROM barcode WHERE 1";
                Yii::$app->db->createCommand($mysql)
                    ->execute();
                Yii::$app->session->setFlash('success',"Presenze del giorno caricate con successo");

            }
            elseif (Yii::$app->request->post('submit') === 'chiudisessionecolazione') {
// Extract the presence and email to the administrator  the table t
                $mysql = "SELECT * FROM `barcode` WHERE 1;";
                Yii::$app->db->createCommand($mysql)
                    ->execute();

                $mysql = "INSERT INTO Colazioni (entrata, id) SELECT barcode.entrance , barcode.id FROM barcode WHERE 1;";
                Yii::$app->db->createCommand($mysql)
                    ->execute();
                $mysql = "DELETE FROM barcode WHERE 1";
                Yii::$app->db->createCommand($mysql)
                    ->execute();

            }
            elseif (Yii::$app->request->post('submit') === 'esporta-report') {
                return  $this->redirect(['barcode/export']);
            }

            elseif (Yii::$app->request->post('submit') === 'email-report') {
           //   return   Yii::$app->runAction('emailreport/compose', ['email' => 'abaldi@tiscali.it']);
          //     return  $this->redirect(['emailreport/view', 'email' => 'abaldi@tiscali.it']);
                return  $this->redirect(['emailreport/index']);
            }

        }
       return $this->redirect(['indexe']);
    }


    public function parseinput($barco)
    {


        // Remove all text  from the  reader and leave the numeric ID only
        $barco = preg_replace("/[^0-9]/", '', $barco);

            $qr = (new \yii\db\Query());

            $qr->select('[[Ospiti.id]]')
                ->from('{{Ospiti}}')
                ->where('[[Ospiti.id]] = (SELECT MAX(ID) FROM Ospiti)');

            $rows = $qr->all();
            $maxid= $rows[0]['id'];

        //print_r($maxid);
        if ($barco > $maxid || $barco ==0) {
            $barco_err = "Numero di Tessera Invalido:".$barco." Ultima tessera:" . $maxid;
            Yii::$app->session->setFlash('error',$barco_err);
            return (-1);
        }
        else return ($barco);
    }


    public function getPagination($request_params){
        $param_val = 'page';
        foreach($request_params as $key => $value){
            if (strpos($key, '_tog') !== false) {
                $param_val = $value;
            }
        }
        $pagination = array();
        if($param_val == 'all'){ //returns empty array, which will show all data.
            return $pagination;
        }else if($param_val == 'page'){ //return pageSize as 5
            $pagination = ['pageSize' => 8];
            return $pagination;
        }
        return $pagination;  // returns empty array again.
    }
}





