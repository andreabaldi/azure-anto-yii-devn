<?php
   namespace frontend\models;
   use yii\base\Model;
   class UploadFileListPrint extends Model {
      public $list;
      public function rules() {
         return [
            [['list'], 'file', 'skipOnEmpty' => false, 'extensions' => 'txt'],
         ];
      }
      public function upload() {
         if ($this->validate()) {
            $this->list->saveAs('../uploads/' . $this->list->baseName . '.' .
               $this->list->extension);
            return true;
         } else {
            return false;
         }
      }
   }
?>