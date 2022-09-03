<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "categoria".
 *
 * @property int $id
 * @property string|null $nombre
 * @property string|null $descripción
 * @property string $imagen
 * @property int $orden
 * @property bool|null $activo
 * @property int|null $categoria_padre
 *
 * @property Categoria $categoriaPadre
 * @property Categoria[] $categorias
 * @property Destinos[] $destinos
 */
class Categoria extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $image;
    public static function tableName()
    {
        return 'categoria';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['orden','nombre',], 'required'],
            [['orden', 'categoria_padre'], 'integer'],
            [['activo'], 'boolean'],
            [['nombre'], 'string', 'max' => 45],
            [['descripción'], 'string', 'max' => 255],
            [['imagen'], 'file', 'extensions' => 'jpg, png, jpeg', 'maxFiles' => '1'],
            [['categoria_padre'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria::className(), 'targetAttribute' => ['categoria_padre' => 'id']],
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
            'descripción' => Yii::t('app', 'Descripción'),
            'imagen' => Yii::t('app', 'Imagen'),
            'orden' => Yii::t('app', 'Orden'),
            'activo' => Yii::t('app', 'Activo'),
            'categoria_padre' => Yii::t('app', 'Categoria Padre'),
        ];
    }

    /**
     * Gets query for [[CategoriaPadre]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategoriaPadre()
    {
        return $this->hasOne(Categoria::className(), ['id' => 'categoria_padre']);
    }

    /**
     * Gets query for [[Categorias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategorias()
    {
        return $this->hasMany(Categoria::className(), ['categoria_padre' => 'id']);
    }

    /**
     * Gets query for [[Destinos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDestinos()
    {
        return $this->hasMany(Destinos::className(), ['categoria_id' => 'id']);
    }
}
