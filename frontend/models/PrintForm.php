<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * PrintForm is the model behind the print form.
 */
class PrintForm extends Model
{
    public $start;
    public $stop;
    public $filelist;



    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return (
            // start, stop
            [['start', 'start'],
            ['stop', 'stop'],
            ['filelist', 'filelist'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'filelist' => 'filelist ',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the email was sent
     */
    public function sendEmail($email)
    {
        
    }
}
