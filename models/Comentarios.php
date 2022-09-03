<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comentarios".
 *
 * @property int $id
 * @property string $comentario
 * @property string $fecha
 * @property int $destinos_id
 * @property string $nombre
 * @property int $puntuacion
 *
 * @property Destinos $destinos
 */
class Comentarios extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comentarios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['comentario', 'destinos_id', 'nombre','puntuacion'], 'required'],
            [['fecha'], 'safe'],
            [['destinos_id', 'puntuacion'], 'integer'],
            [['comentario'], 'string', 'max' => 500],
            [['nombre'], 'string', 'max' => 100],
            [['destinos_id'], 'exist', 'skipOnError' => true, 'targetClass' => Destinos::className(), 'targetAttribute' => ['destinos_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'comentario' => Yii::t('app', 'Comentario'),
            'fecha' => Yii::t('app', 'Fecha'),
            'destinos_id' => Yii::t('app', 'Destinos ID'),
            'nombre' => Yii::t('app', 'Nombre'),
            'puntuacion' => Yii::t('app', 'Puntuacion'),
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
}
