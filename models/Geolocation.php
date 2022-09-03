<?php

namespace app\models;

use Yii;
use sjaakp\spatial\ActiveRecord;

/**
 * This is the model class for table "geolocation".
 *
 * @property int $id
 * @property string|null $location
 * @property string|null $mapcenter
 * @property int|null $mapzoom
 * @property int $destinos_id
 *
 * @property Destinos $destinos
 */
class Geolocation extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'geolocation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['location', 'mapcenter'], 'string'],
            [['mapzoom', 'destinos_id'], 'integer'],
            [['destinos_id'], 'required'],
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
            'location' => Yii::t('app', 'Location'),
            'mapcenter' => Yii::t('app', 'Mapcenter'),
            'mapzoom' => Yii::t('app', 'Mapzoom'),
            'destinos_id' => Yii::t('app', 'Destinos ID'),
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
