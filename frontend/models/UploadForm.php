<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $file;

    public function rules()
    {
        return [
            ['file', 'file', 'skipOnEmpty' => false, 'extensions' => 'zip'],
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            this->allegato = UploadedFile::getInstance($model, 'allegato');
            $this->allegato->saveAs('../uploads/' . $this->file->baseName . '.' . $this->file->extension);$model->allegato->saveAs('../uploads/' . $model->allegato->baseName . '.' . $model->allegato->extension);
            this->allegato = '../uploads/' . this->allegato->baseName . '.' . this->allegato->extension;


            return true;
        } else {
            return false;
        }
    }
}
