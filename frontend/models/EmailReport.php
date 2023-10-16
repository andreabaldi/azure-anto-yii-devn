<?php

namespace frontend\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "Emailreport".
 *
 * @property string|null $nome
 * @property string|null $cognome
 * @property string $email
 * @property string|null $oggetto
 * @property string|null $corpo
 * @property string|null $allegato
 */
class Emailreport extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Emailreport';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email'], 'required'],
            [['nome', 'cognome'], 'string', 'max' => 40],
            [['email'], 'string', 'max' => 60],
            [['oggetto'], 'string', 'max' => 128],
            [['corpo'], 'string', 'max' => 512],
            ['allegato', 'file', 'skipOnEmpty' => true, 'extensions' => 'csv,txt,pdf'],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'nome' => 'Nome',
            'cognome' => 'Cognome',
            'email' => 'Email',
            'oggetto' => 'Oggetto',
            'corpo' => 'Corpo',
            'allegato' => 'Allegato',
        ];
    }


    public function upload()
    {
        if ($this->validate()) {

            $this->allegato = UploadedFile::getInstance($this, 'allegato');
            $this->allegato->saveAs('../uploads/' . $this->allegato->baseName . '.' . $this->allegato->extension);
            $this->allegato = '../uploads/' . $this->allegato->baseName . '.' . $this->allegato->extension;
            $this->save();

            return true;
        } else {
            return false;
        }
    }

}




   
