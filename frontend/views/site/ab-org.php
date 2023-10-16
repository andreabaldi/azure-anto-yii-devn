<?php

/** @var yii\web\View $this */


use kartik\daterange\DateRangePicker;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

$this->title = 'AB Testing page ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-ab-test">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php
    echo "php code starts"." --: ".date('l jS \of F Y h:i:s A')."<br>";

    $array1 = array(0 => 'zero_a', 2 => 'two_a', 3 => 'three_a');
    $array2 = array(1 => 'one_b', 3 => 'three_b', 4 => 'four_b');
    $result = $array1 + $array2;
    
    var_dump($result);
    Yii::$app->view->on('EVENT_END_BODY', function () {
        echo date('Y-m-dd');
    });
    
    
 

$fdate = '';

$d1 = date('Y-m-d')." 23:59:59";
$d2 = date('Y-m-d', strtotime($d1. ' - 30 days'))." 00:00:00";


    echo DateRangePicker::widget([
    'name' => 't1_t2',
    'id' =>'t1-t2',
   // 'model'=>$model,
     'presetDropdown'=>true,    
    'includeMonthsFilter'=>true,
    'attribute'=>'datetime_range',
    'convertFormat'=>true,
    'pluginOptions'=>[
        'format'=>'yyyy-MM-dd',
    ]
]);;
    $this->title = 'Content Types';
$this->params['breadcrumbs'][] = $this->title;
$gridColumns = ['id', 'nome', 'cognome', 'nascita', 'genere', ['class' => 'kartik\\grid\\ActionColumn']];
?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-sm-11">Filter</div>
                <div class="col-sm-1">
                    <?php 
if (isset($dataProvider)) {
    $columnExport = ['id', 'nome', 'cognome', 'nascita', 'genere'];
    echo ExportMenu::widget(['dataProvider' => $dataProvider, 
    'columns' => $columnExport, 
    'class' => 'yii\grid\CheckboxColumn',
    'showConfirmAlert' => false, 
    'showColumnSelector' => true, 
    'target' => ExportMenu::TARGET_SELF, 
    'exportConfig' => [ExportMenu::FORMAT_HTML => ['label' => 'Export HTML'], 
                       ExportMenu::FORMAT_EXCEL => ['label' => 'Export Excel'], 
                       ExportMenu::FORMAT_EXCEL_X => ['label' => 'Export Excel X'], 
                       ExportMenu::FORMAT_PDF => ['label' => 'Export PDF'], 
                       ExportMenu::FORMAT_TEXT => ['label' => 'Export Tex'],   
                       ExportMenu::FORMAT_CSV => ['label' => 'Export CSV']], 
    'filename' => date('Y-m-d')]);
}




?>

<?php

//require_once( \Yii::getAlias('@vendor/tecnickcom/tcpdf/tcpdf.php') );
include_once(Yii::getAlias('@vendor/tecnickcom/tcpdf/tessere/GenTesseraBpdf.php') );

$doc = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$doc->AddPage('L',"A4");
// Set position  for the tessere
$xpos = array(
    0,
    95,
    190);
$ypos = array(
        0,
        55,
        110);


$count = 15;
        while($count > 0){

            for($j = 0, $ysize = count($ypos); $j < $ysize && $count >0; ++$j) {

                for($i = 0, $xsize = count($xpos); $i < $xsize && $count >0; ++$i) {
                  //  $row = mysqli_fetch_array($result);
                --$count;
                DisplayTessera($doc, 112,'nome','cognome','1959-02-28',$xpos[$i] ,$ypos[$j]);
            }
        }
        if ($count >0) $doc->AddPage('L',"A4");
    }

 $doc->Output('/Applications/MAMP/htdocs/advanced/tessere/'.'TS-'.'print'.'.pdf', 'F');
echo "Andrea"."Andrea";
?>

                </div>
            </div>
        </div>
        <div class="panel-body">
            <div class="form">
                <?php 
if (isset($dataProvider)) {
    echo '<div id="filter_field" style="display:none;">';
} else {
    echo '<div id="filter_field" style="display:block;">';
}
?>

                <?php 
$form = ActiveForm::begin();
?>
                    <div class="row">
  <?                  
  /** @var \backend\models\Ospiti $ospite */
$form->field($ospite, 'id')->textInput() ;
$form->field($ospite, 'nome')->textInput(['maxlength' => true]) ;
$form->field($ospite, 'cognome')->textInput(['maxlength' => true]) ;
$form->field($ospite, 'nascita')->textInput() ;
$form->field($ospite, 'genere')->textInput(['maxlength' => true]) ;
$form->field($ospite, 'nazionalita')->textInput(['maxlength' => true]) ;
?>

                    <div class="form-group">
                        <?php 
echo Html::submitButton('View', ['class' => 'btn btn-success', 'id' => 'view_button']);
?>
                    </div>
                <?php 
ActiveForm::end();
?>

                <?php 
echo '</div>';
?>
                 <?php 
if (isset($dataProvider)) {
    echo Html::button('Filter', ['class' => 'btn btn-success', 'id' => 'filter_button']);
}
?>
            </div>
        </div>
    </div>    

<div class="content-type-index">
    
    <?php 
if (isset($dataProvider)) {
    Pjax::begin(['id' => 'content-type-grid', 'enablePushState' => false]);
    ?>
    <?php 
    echo GridView::widget(['dataProvider' => $dataProvider, 'columns' => $gridColumns, 'filterSelector' => "input[name='" . $dataProvider->getPagination()->pageSizeParam . "'],input[name='" . $dataProvider->getPagination()->pageParam . "']", 'hover' => true, 'panel' => ['type' => GridView::TYPE_PRIMARY, 'heading' => '<b class="title">' . Html::encode($this->title) . '</b>'], 'export' => false, 'toggleData' => false]);
    Pjax::end();
}
?>
</div>

<?php 
$js = <<<JS
    \$("#view_button").click(function(){
        \$("#filter_field").toggle("slow",function(){});
    });
        
    \$('#filter_button').click(function(){
        \$('#filter_field').toggle("slow",function(){
            \$('#filter_button').hide();
        });
    });
JS;
$this->registerJs($js);
    
    echo "<br>"." PHP code ends!"."<br>";
    ?>   
    </p>
</div>
