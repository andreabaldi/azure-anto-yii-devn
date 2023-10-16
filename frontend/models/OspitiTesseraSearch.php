<?php
namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 * OspitiSearch represents the model behind the search form of `frontend\models\Ospiti`.
 */
class OspitiTesseraSearch extends OspitiTessera
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['cognome', 'nome', 'nascita', 'genere', 'nazionalita'], 'safe'],
            [['dataRilascio', 'dataUltimoRinnovo', 'dataScadenza','printme'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

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


    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = OspitiTessera::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pagesize' =>10],
        ]);


        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'nascita' => $this->nascita,
            'dataRilascio' => $this->dataRilascio,
            'dataUltimoRinnovo' => $this->dataUltimoRinnovo,
            'dataScadenza' => $this->dataScadenza,
             'printme' => $this->printme,
        ]);

        $query->andFilterWhere(['like', 'cognome', $this->cognome])
            ->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'genere', $this->genere])
            ->andFilterWhere(['like', 'nazionalita', $this->nazionalita]);
           

        return $dataProvider;
    }
}
