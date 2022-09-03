<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "empresa".
 *
 * @property int $id
 * @property string $nombre
 * @property string $descripcion
 * @property string $logo
 * @property string $telefono
 * @property string|null $email
 * @property string|null $website
 * @property string|null $ubicacion_gps
 * @property bool $status 1 = Activo 0 = Inactivo
 *
 * @property Destinos[] $destinos
 */
class Empresa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    // Despues del class
    public $image;
    public static function tableName()
    {
        return 'empresa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'descripcion','telefono'], 'required'],
            /* [['ubicacion_gps'], 'string'], */
            [['status'], 'boolean'],
            [['nombre'], 'string', 'max' => 100],
            [['descripcion'], 'string', 'max' => 255],
            [['telefono'], 'string', 'max' => 20],
            [['email', 'website'], 'string', 'max' => 45],
            ['email', 'email'],
            ['telefono', 'number'],
            ['website', 'url'],
            [['logo'], 'file', 'extensions' => 'jpg, png, jpeg, gif', 'maxFiles' => '1'],

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
            'descripcion' => Yii::t('app', 'Descripción'),
            'logo' => Yii::t('app', 'Logo'),
            'telefono' => Yii::t('app', 'Telefono'),
            'email' => Yii::t('app', 'Email'),
            'website' => Yii::t('app', 'Sitio web'),
            'ubicacion_gps' => Yii::t('app', 'Ubicación Gps'),
            'status' => Yii::t('app', 'Estatus'),
        ];
    }

    /**
     * Gets query for [[Destinos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDestinos()
    {
        return $this->hasMany(Destinos::className(), ['empresa_id' => 'id']);
    }
}
