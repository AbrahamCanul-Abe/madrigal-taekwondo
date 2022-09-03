<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "multimedia".
 *
 * @property int $id
 * @property string|null $nombre
 * @property string|null $descripcion
 * @property string|null $url
 * @property int|null $tipo
 * @property int $contenido_id
 *
 * @property Destinos $contenido
 * @property Destinos $destinos
 */
class Multimedia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'multimedia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tipo', 'contenido_id'], 'integer'],
            [['contenido_id'], 'required'],
            [['nombre'], 'string', 'max' => 45],
            [['descripcion'], 'string', 'max' => 100],
            [['url'], 'string', 'max' => 255],
            [['contenido_id'], 'exist', 'skipOnError' => true, 'targetClass' => Destinos::className(), 'targetAttribute' => ['contenido_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'nombre' => Yii::t('app', 'Nombre'),
            'descripcion' => Yii::t('app', 'Descripcion'),
            'url' => Yii::t('app', 'Url'),
            'tipo' => Yii::t('app', 'Tipo'),
            'contenido_id' => Yii::t('app', 'Contenido de:'),
        ];
    }

    /**
     * Gets query for [[Contenido]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getContenido()
    {
        return $this->hasOne(Destinos::className(), ['id' => 'contenido_id']);
    }
    public function getDestinos()
    {
        return $this->hasOne(Destinos::className(), ['id' => 'contenido_id']);
    }
}
