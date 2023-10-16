<?php

namespace frontend\models;

use frontend\models\Form;
use frontend\models\Html;

/**
 * This is the model class for table "Ospiti".
 *
 * @property int $id
 * @property string|null $cognome
 * @property string|null $nome
 * @property string|null $nascita
 * @property string $genere
 * @property string $nazionalita
 *
 * @property Presenze[] $presenzes
 * @property Tessera $tessera
 */
class Ospiti extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Ospiti';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'cognome', 'nome', 'genere', 'nazionalita'], 'required'],
            [['id'], 'integer'],
            //[['nascita'], 'safe'],
            ['nascita', 'default', 'value' =>'1900-01-01'],
            [['cognome', 'nome'], 'string', 'max' => 30],
            [['genere'], 'string', 'max' => 1],
            [['nazionalita'], 'string', 'max' => 25],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Numero Tessera',
            'cognome' => 'Cognome',
            'nome' => 'Nome',
            'nascita' => 'Nascita',
            'genere' => 'Genere',
            'nazionalita' => 'Nazionalita',
        ];
    }

    
    
    public function getFormAttribs() {
        return [
            'id' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter username...']],
            'cognome' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter username...']],
            'nome' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter username...']],
            'nascita' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter username...']],
            'genere' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter username...']],
            'nazionalita' => ['type'=>Form::INPUT_TEXT, 'options'=>['placeholder'=>'Enter username...']],
             'actions'=>['type'=>Form::INPUT_RAW, 'value'=>Html::submitButton('Submit', ['class'=>'btn btn-primary'])]];
        
}   
    
    /**
     * Gets query for [[Presenzes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPresenzes()
    {
        return $this->hasMany(Presenze::class, ['id' => 'id']);
    }

    /**
     * Gets query for [[Tessera]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTessera()
    {
        return $this->hasOne(Tessera::class, ['id' => 'id']);
    }
}
