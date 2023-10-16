    <?php

use frontend\models\OspitiTessera;
use kartik\grid\GridView;
use yii\grid\ActionColumn;
use sjaakp\alphapager\ActiveDataProvider;
use sjaakp\alphapager\AlphaPager;
use yii\helpers\Html;

//use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var \backend\models\Ospiti $model */


$this->title = 'Ospiti & Tessere Paginato';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="presenze-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
           
                <h2> Pager</h2>


        <?php

        $query = OspitiTessera::find()->orderBy('Cognome');

$dataProvider = new ActiveDataProvider([
    'query' => $query,
    'alphaAttribute' => 'Cognome',
    'alphaDigits' => 'compact',                // one button for digits '0' - '9'
    'alphaPages' => [
//        'P' => [
//               'label' => 'pq',                // label button 'P' with 'pq'
//               'pattern' => [ '[PpQq]' ],      // regular expression: include words starting with 'Q' under 'P'
//           ],
//        'Q' => false,                          // suppress page 'Q'
//        'Z' => [
//               'label' => 'x-z',               // label button 'Z' with 'x-z'
//               'pattern' => [ '[X-Zx-z]' ],    // regular expression: include words starting with 'X' or 'Y' under 'Z'
//           ],
       // 'X' => false,                          // suppress page 'X'
       // 'Y' => false,                          // suppress page 'Y'
    ],
    'pagination' => false                      // switch off normal pagination
]);
?>

<?= AlphaPager::widget([
    'dataProvider' => $dataProvider,
    'preButtons' => ['all'],                       // no 'all' button
    'lowerCase' => false                       // buttons in lower case
]) ?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'cognome:ntext',
        'nome:ntext',
        'nascita:ntext',
        'genere:ntext',
        'dataScadenza',
        [
            'class' => ActionColumn::className(),
            'template' => '{view}{update}',
        ],
                
    ],
    'rowOptions' => function($model,$key,$index,$widget){
        if ($model['dataScadenza'] < date("Y-m-d")) {
            return ['class' => 'table-danger',];
        } elseif ($model['dataScadenza']  == date("Y-m-d")) {
            return ['class' => 'table-warning',];
        }
        else return ['class' => 'table-success',];
    },


]); ?>


</div>
