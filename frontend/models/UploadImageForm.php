<?php
   namespace frontend\models;
   use yii\base\Model;
   class UploadImageForm extends Model {
      public $image;
      public function rules() {
         return [
            [['image'], 'file', 'skipOnEmpty' => false, 'extensions' => 'csv, txt'],
         ];
      }
      public function upload() {
         if ($this->validate()) {
            $this->image->saveAs('../uploads/' . $this->image->baseName . '.' .
               $this->image->extension);
            return true;
         } else {
            return false;
         }
      }
   }
?>