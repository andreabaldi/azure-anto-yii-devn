<?php

namespace frontend\models;

/**
 * This is the ActiveQuery class for [[Barcode]].
 *
 * @see Barcode
 */
class BarcodeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Barcode[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Barcode|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
