<?php

namespace frontend\models;

/**
 * This is the ActiveQuery class for [[Statoservizio]].
 *
 * @see Statoservizio
 */
class StatoservizioQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Statoservizio[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Statoservizio|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
