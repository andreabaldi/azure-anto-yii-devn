
    GridView::widget([
        'id' => 'kvgrid',
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            //['class' => 'yii\grid\SerialColumn'],
            ['class' => 'yii\grid\CheckboxColumn'],
            'nome',
            'cognome',
            'nascita',
            ['attribute' => 'nazionalita',
            'width' => '310px',
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(Ospiti::find()->orderBy('nazionalita')->asArray()->all(), 'id', 'nazionalita'), 
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true],
            ],
            'filterInputOptions' => ['placeholder' => 'SCONOSCIUTA']],
            'genere',
            'dataRilascio',
            'dataUltimoRinnovo',
            'dataScadenza',
            'QRfilename',
             'TSfilename',
             [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Ospiti $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 },
                 'template' => '{view}{update}',
                ],
            
        ],