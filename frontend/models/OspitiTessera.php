<?php

namespace frontend\models;

/**
 * This is the model class for table "OspitiTessera".
 *
 * @property int $id
 * @property string|null $nome
 * @property string|null $cognome
 * @property string|null $nascita
 * @property string $genere
 * @property string $nazionalita
 * @property string $dataRilascio
 * @property string $dataUltimoRinnovo
 * @property string $dataScadenza
 * @property string $QRfilename
 * @property string $TSfilename
 * @property boolean $printme
 */
class OspitiTessera extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'OspitiTessera';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'genere', 'nazionalita', 'dataRilascio', 'dataUltimoRinnovo', 'dataScadenza', 'QRfilename', 'TSfilename','printme'], 'required'],
            [['id'], 'integer'],
            [['nascita', 'dataRilascio', 'dataUltimoRinnovo', 'dataScadenza'], 'safe'],
            [['nome', 'cognome'], 'string', 'min' => 1 ,'max' => 30],
            [['genere'], 'string', 'min' => 5 ,'max' => 30],
            [['nazionalita'], 'string', 'max' => 25],
            ['printme', 'in', 'range' => [0,1, 2,3]],
        ];
    }
    public static function primaryKey()

    {

        return array('id');

    }


    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'cognome' => 'Cognome',
            'nascita' => 'Nascita',
            'genere' => 'Genere',
            'nazionalita' => 'Nazionalita',
            'dataRilascio' => 'Data Rilascio',
            'dataUltimoRinnovo' => 'Data Ultimo Rinnovo',
            'dataScadenza' => 'Data Scadenza',
            'printme' => 'In Stampa',

        ];
    }
}
