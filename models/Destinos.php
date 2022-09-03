<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "destinos".
 *
 * @property int $id
 * @property string $nombre
 * @property string $descripcion_corta
 * @property string|null $descripcion_larga
 * @property string $hora_apertura
 * @property string $hora_cierre
 * @property int|null $aforo
 * @property string|null $informacion_adicional
 * @property string $ubicacion
 * @property string $infraestructura
 * @property string $actividades
 * @property string $servicios
 * @property string $inclusion
 * @property bool|null $status 1 = Activo 0 = Inactivo
 * @property string $fecha_alta
 * @property int $categoria_id
 * @property int $empresa_id
 *
 * @property Calificaciones[] $calificaciones
 * @property Comentarios[] $comentarios
 * @property Categoria $categoria
 * @property Empresa $empresa
 * @property Multimedia[] $multimedia
 */
class Destinos extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'destinos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'descripcion_corta', 'hora_apertura', 'hora_cierre', 'ubicacion', 'categoria_id', 'empresa_id'], 'required'],
            [['descripcion_larga', 'ubicacion'], 'string'],
            [['infraestructura', 'actividades', 'servicios', 'inclusion', 'hora_apertura', 'hora_cierre','fecha_alta'], 'safe'],
            [['aforo', 'categoria_id', 'empresa_id'], 'integer'],
            [['status'], 'boolean'],
            [['nombre'], 'string', 'max' => 45],
            [['descripcion_corta'], 'string', 'max' => 100],
            [['informacion_adicional'], 'string', 'max' => 255],
            [['categoria_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria::className(), 'targetAttribute' => ['categoria_id' => 'id']],
            [['empresa_id'], 'exist', 'skipOnError' => true, 'targetClass' => Empresa::className(), 'targetAttribute' => ['empresa_id' => 'id']],
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
            'descripcion_corta' => Yii::t('app', 'Descripción Corta'),
            'descripcion_larga' => Yii::t('app', 'Descripción Larga'),
            'hora_apertura' => Yii::t('app', 'Hora Apertura'),
            'hora_cierre' => Yii::t('app', 'Hora Cierre'),
            'aforo' => Yii::t('app', 'Aforo'),
            'informacion_adicional' => Yii::t('app', 'Información Adicional'),
            'ubicacion' => Yii::t('app', 'Ubicación'),
            'infraestructura' => Yii::t('app', 'Infraestructura'),
            'actividades' => Yii::t('app', 'Actividades'),
            'servicios' => Yii::t('app', 'Servicios'),
            'inclusion' => Yii::t('app', 'Inclusión'),
            'status' => Yii::t('app', 'Activo'),
            'fecha_alta' => Yii::t('app', 'Fecha Alta'),
            'categoria_id' => Yii::t('app', 'Tipo de destino'),
            'empresa_id' => Yii::t('app', 'Propietario'),
        ];
    }

    /**
     * Gets query for [[Calificaciones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCalificaciones()
    {
        return $this->hasMany(Calificaciones::className(), ['destinos_id' => 'id']);
    }

    /**
     * Gets query for [[Comentarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComentarios()
    {
        return $this->hasMany(Comentarios::className(), ['destinos_id' => 'id']);
    }

    /**
     * Gets query for [[Categoria]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria()
    {
        return $this->hasOne(Categoria::className(), ['id' => 'categoria_id']);
    }

    /**
     * Gets query for [[Empresa]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmpresa()
    {
        return $this->hasOne(Empresa::className(), ['id' => 'empresa_id']);
    }

    /**
     * Gets query for [[Multimedia]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMultimedia()
    {
        return $this->hasMany(Multimedia::className(), ['contenido_id' => 'id']);
    }
}
