<?php

namespace frontend\controllers;

use frontend\models\Ospiti;
use frontend\models\OspitiSearch;
use yii\data\ArrayDataProvider;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * OspitiController implements the CRUD actions for Ospiti model.
 */
class OspitiController extends Controller
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
     * Lists all Ospiti models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new OspitiSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Ospiti model.
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
     * Creates a new Ospiti model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Ospiti();

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
     * Creates a new Ospiti model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreateb()
    {
        $model = new Ospiti();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('createB', [
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
     * Deletes an existing Ospiti model.
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
     * Finds the Ospiti model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Ospiti the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Ospiti::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionMyindex()
    {
    

    //Create a query builder object
    $qr = (new \yii\db\Query());
    //Compose  the  query using [[]] and {{}}


    $d1 = date('Y-m-d')." 23:59:59";
        
    $d2 = date('Y-m-d', strtotime($d1. ' - 10 days'))." 00:00:00";

    $qr->select('[[Ospiti.id]], 
    [[Ospiti.nome]], 
    [[Ospiti.cognome]], 
    [[Ospiti.nazionalita]], 
    [[Tessera.dataRilascio]], 
    [[Tessera.dataUltimoRinnovo]], 
    [[Tessera.dataScadenza]], 
    [[Tessera.QRfilename]], 
    [[Tessera.TSfilename]]')
    ->from('{{Ospiti}}')
    ->innerJoin('{{Tessera}}', '[[Ospiti.id]] = [[Tessera.id]]')
    ->where('[[Tessera.dataRilascio]]  BETWEEN "'.$d2.'" AND "'. $d1.'"')
    ->limit(250);
 // buiold and executre the query made then avaiable in rows
    $rows = $qr->all();   

    $dataprovider = new ArrayDataProvider([
        // 'allModels' => $query->queryAll(),
         'allModels' => $rows,
         'sort' => [
             'attributes' => ['id','cognome', 'nome', 'nazionalita'],
         ],
         'pagination' => [
             'pageSize' => 25,
         ],
         ]);
     
         
             return $this->render('myindex',
                ['dataProvider' =>$dataprovider,]
         );

}
}


