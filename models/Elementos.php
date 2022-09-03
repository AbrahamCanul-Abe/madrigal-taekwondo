<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "elementos".
 *
 * @property int $id
 * @property string|null $descripcion
 * @property int $tipo_id
 *
 * @property Tipo $tipo
 */
class Elementos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'elementos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipo_id'], 'required'],
            [['tipo_id'], 'integer'],
            [['descripcion'], 'string', 'max' => 45],
            [['tipo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tipo::className(), 'targetAttribute' => ['tipo_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'descripcion' => Yii::t('app', 'Descripcion'),
            'tipo_id' => Yii::t('app', 'Tipo ID'),
        ];
    }

    /**
     * Gets query for [[Tipo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTipo()
    {
        return $this->hasOne(Tipo::className(), ['id' => 'tipo_id']);
    }
}
