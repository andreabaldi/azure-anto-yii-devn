<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "Statoservizio".
 *
 * @property int $id
 * @property string $stato
 * @property string|null $sospesaDa
 * @property string|null $sospesaAl
 * @property string $info
 */
class Statoservizio extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Statoservizio';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'info'], 'required'],
            // just check the possible id building a range array required by teh validator
            ['id', 'in', 'range' => \frontend\models\OspitiTessera::find()->select('id')->asArray()->column()],
            [['sospesoDa', 'sospesoAl'], 'safe'],
            [['info'], 'string'],
            [['stato'], 'string', 'max' => 16],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'stato' => 'Stato',
            'sospesoDa' => 'Sospeso Da',
            'sospesoAl' => 'Sospeso Al',
            'info' => 'Info',
        ];
    }
}
