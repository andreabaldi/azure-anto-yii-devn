<?php

namespace frontend\models;

use backend\models\Presenze;
use kartik\daterange\DateRangeBehavior;
use yii\data\ActiveDataProvider;

class PresenzeSearcht extends Presenze
{
    

    public $TimeStart;
    public $TimeEnd;

    public function behaviors()
    {
        return [
            [
                'class' => DateRangeBehavior::className(),
                'dateStartAttribute' => 'TimeStart',
                'dateEndAttribute' => 'TimeEnd',
            ]
        ];
    }

     public function rulesa()
    {
        return [
            // ...
            [['data_range'], 'match', 'pattern' => '/^.+\s\-\s.+$/'],
            [['datetime_range'], 'match', 'pattern' => '/^.+\s\-\s.+$/'],
        ];
    }

    public function search($params)
    {
        $query = Presenze::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        $this->load($params);
        var_dump($query);
        var_dump($this->TimeStart);
        var_dump($this->TimeEnd);
        if (!$this->validate()) {
         //  $query->where('0=1');
                  return $dataProvider;
        }
 

        $query->andFilterWhere(['>=', 'entrata', $this->TimeStart])
              ->andFilterWhere(['<', 'entrata', $this->TimeEnd]);


        return $dataProvider;
    }
}

?>