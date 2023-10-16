<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "EmailReport".
 *
 * @property string|null $nome
 * @property string|null $cognome
 * @property string|null $email
 * @property string|null $oggetto
 * @property string|null $corpo
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
            [['nome', 'cognome'], 'string', 'max' => 40],
            [['email'], 'string', 'max' => 60],
            [['oggetto'], 'string', 'max' => 128],
            [['corpo'], 'string', 'max' => 512],
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
        ];
    }
}
