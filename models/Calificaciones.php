<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "calificaciones".
 *
 * @property int $id
 * @property int|null $calificacion
 * @property string|null $fecha
 * @property int $usuarios_id
 * @property int $destinos_id
 * @property int $turista_id
 *
 * @property Destinos $destinos
 * @property Turista $turista
 */
class Calificaciones extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'calificaciones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'usuarios_id', 'destinos_id', 'turista_id'], 'required'],
            [['id', 'calificacion', 'usuarios_id', 'destinos_id', 'turista_id'], 'integer'],
            [['fecha'], 'safe'],
            [['id'], 'unique'],
            [['destinos_id'], 'exist', 'skipOnError' => true, 'targetClass' => Destinos::className(), 'targetAttribute' => ['destinos_id' => 'id']],
            [['turista_id'], 'exist', 'skipOnError' => true, 'targetClass' => Turista::className(), 'targetAttribute' => ['turista_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'calificacion' => Yii::t('app', 'Calificacion'),
            'fecha' => Yii::t('app', 'Fecha'),
            'usuarios_id' => Yii::t('app', 'Usuarios ID'),
            'destinos_id' => Yii::t('app', 'Destinos ID'),
            'turista_id' => Yii::t('app', 'Turista ID'),
        ];
    }

    /**
     * Gets query for [[Destinos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDestinos()
    {
        return $this->hasOne(Destinos::className(), ['id' => 'destinos_id']);
    }

    /**
     * Gets query for [[Turista]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTurista()
    {
        return $this->hasOne(Turista::className(), ['id' => 'turista_id']);
    }
}
