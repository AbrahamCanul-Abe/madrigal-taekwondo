<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "turista".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $lastname
 * @property int|null $sex
 * @property string|null $city
 * @property int $country_id
 * @property string|null $age
 * @property string|null $places_of_interest
 * @property string|null $reason_of_visit
 * @property string|null $with_whom_travel 1 - solo 2 - con compañeros 3 - con amigos 4 - en familia
 * @property string|null $username
 * @property string|null $email
 * @property string|null $password
 * @property string|null $fecha_alta
 * @property bool|null $status
 *
 * @property Calificaciones[] $calificaciones
 * @property Comentarios[] $comentarios
 * @property Country $country
 */
class Turista extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'turista';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'country_id'], 'required'],
            [['id', 'sex', 'country_id'], 'integer'],
            [['fecha_alta'], 'safe'],
            [['status'], 'boolean'],
            [['name', 'lastname', 'city', 'age', 'places_of_interest', 'reason_of_visit', 'with_whom_travel', 'username', 'password'], 'string', 'max' => 45],
            [['email'], 'string', 'max' => 100],
            [['id'], 'unique'],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['country_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'lastname' => Yii::t('app', 'Lastname'),
            'sex' => Yii::t('app', 'Sex'),
            'city' => Yii::t('app', 'City'),
            'country_id' => Yii::t('app', 'Country ID'),
            'age' => Yii::t('app', 'Age'),
            'places_of_interest' => Yii::t('app', 'Places Of Interest'),
            'reason_of_visit' => Yii::t('app', 'Reason Of Visit'),
            'with_whom_travel' => Yii::t('app', 'With Whom Travel'),
            'username' => Yii::t('app', 'Username'),
            'email' => Yii::t('app', 'Email'),
            'password' => Yii::t('app', 'Password'),
            'fecha_alta' => Yii::t('app', 'Fecha Alta'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * Gets query for [[Calificaciones]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCalificaciones()
    {
        return $this->hasMany(Calificaciones::className(), ['turista_id' => 'id']);
    }

    /**
     * Gets query for [[Comentarios]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComentarios()
    {
        return $this->hasMany(Comentarios::className(), ['turista_id' => 'id']);
    }

    /**
     * Gets query for [[Country]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Country::className(), ['id' => 'country_id']);
    }
}
