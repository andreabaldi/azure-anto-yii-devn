<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "barcode".
 *
 * @property int $id
 * @property string $entrance
 */
class Barcode extends \yii\db\ActiveRecord
{
    

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'barcode';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'entrance'], 'required'],
            [['id'], 'integer'],
           // [['entrance', 'entrance'], 'datetime'],
           [['entrance'], 'safe'],
            [['id'], 'unique']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'entrance' => 'Entrata',
        ];
    }

    /**
     * {@inheritdoc}
     * @return BarcodeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new BarcodeQuery(get_called_class());
    }
}


