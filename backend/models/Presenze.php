<?php

namespace backend\models;

/**
 * This is the model class for table "Presenze".
 *
 * @property int $id
 * @property string $entrata
 *
 * @property Ospiti $id0
 */
class Presenze extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Presenze';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'entrata'], 'required'],
            [['id'], 'integer'],
            [['entrata'], 'safe'],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => Ospiti::class, 'targetAttribute' => ['id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'entrata' => 'Entrata',
        ];
    }

    /**
     * Gets query for [[Id0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(Ospiti::class, ['id' => 'id']);
    }
}
