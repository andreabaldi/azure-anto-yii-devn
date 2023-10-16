<?php

namespace frontend\controllers;

use frontend\models\EmailReport;
use frontend\models\EmailreportSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use Yii;
/**
 * EmailreportController implements the CRUD actions for Emailreport model.
 */
class EmailreportController extends Controller
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


    /**
     * Lists all Emailreport models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new EmailreportSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Emailreport model.
     * @param string $email Email
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($email)
    {
        return $this->render('view', [
            'model' => $this->findModel($email),
        ]);
    }

   /* Compose a single Emailreport model.
    * @param string $email Email
    * @return string
    * @throws NotFoundHttpException if the model cannot be found
    */
   public function actionCompose($email)
   {
    $model = $this->findModel($email);

    return $this->render('compose', [
           'model' => $this->findModel($email),
       ]);
   }




    /**
     * Creates a new Emailreport model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate1()
    {
        $model = new Emailreport();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()))
              {
                  $model->upload();
                $model->save();
                  return $this->redirect(['view', 'email' => $model->email]);
//print_r($model);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
    public function actionCreate()
    {
        $model = new Emailreport();

        if ($this->request->isPost && $model->load($this->request->post())) {
            $image = UploadedFile::getInstance($model, 'allegato');
            if (!empty($image) && $image->size !== 0) {
                //print_R($image);die;
                $image->saveAs('../uploads/' . $image->baseName . '.' . $image->extension);
                $model->allegato = '../uploads/' . $image->baseName . '.' . $image->extension;
            } else
                $model->allegato = $current_image;
            $model->save();
            return $this->redirect(['view', 'email' => $model->email]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Emailreport model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $email Email
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($email)
    {
        $model = $this->findModel($email);
        $current_image = $model->allegato;
        if ($this->request->isPost && $model->load($this->request->post())) {
            $image = UploadedFile::getInstance($model, 'allegato');
            if (!empty($image) && $image->size !== 0) {
                //print_R($image);die;
                $image->saveAs('../uploads/' . $image->baseName . '.' . $image->extension);
                $model->allegato = '../uploads/' . $image->baseName . '.' . $image->extension;
            } else
                $model->allegato = $current_image;
            $model->save();
            return $this->redirect(['view', 'email' => $model->email]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate1($email)
    {
        $model = $this->findModel($email);

        if ($this->request->isPost && $model->load($this->request->post())) {
            $model->upload();
            $model->save();
            return $this->redirect(['view', 'email' => $model->email]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Emailreport model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $email Email
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($email)
    {
        $this->findModel($email)->delete();

        return $this->redirect(['index']);
    }


/**
     * Send anEmailreport to teh specifed envelope.
     * If email  is successful, the browser will be redirected to the 'index' page.
     * @param string $email Email
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionSendemail($email)
    {
        $report = emailReport::findOne($email);

        $em =  \Yii::$app->mailer->compose()
        ->setTo($email)
        ->setFrom([\Yii::$app->params['senderEmail'] => \Yii::$app->params['senderName']])
        ->setReplyTo($report->email);
        date_default_timezone_set("Europe/Rome");
        $oggetto = "Welcome App:[".date('h:i:sa')."]:'.".$report->oggetto;
        $em->setSubject($oggetto)
        ->setTextBody($report->corpo);
             if (($report->allegato))
                  $em->attach($report->allegato);
        $em->send();
       // print_r($report);
        Yii::$app->session->setFlash('info'," Email Spedita a: ".$email);
       return $this->render('view', [
        'model' => $this->findModel($email),
    ]);


//        Utilizzata nel caso si preferisse attivare una interfaccia di conferma dedicata.
//               return $this->render('confirm', [
//            'model' => $this->findModel($email),
//        ]);
    }

    /**
     * Finds the Emailreport model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $email Email
     * @return Emailreport the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($email)
    {
        if (($model = Emailreport::findOne(['email' => $email])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
