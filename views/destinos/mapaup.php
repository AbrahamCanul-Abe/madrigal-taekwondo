<?php
use sjaakp\locator\Locator;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var $dataProvider ActiveDataProvider
 */
?>
<br>
<br>
<br>
<br>
<div class="container" style="z-index: 1;">

<?php
$form = ActiveForm::begin();

$map = Locator::begin([
    
    'leafletOptions' => [
        'center' =>  [20.69018,-88.20162],   // Valladolid
        'zoom' => 15,
        'scrollWheelZoom' => false,
        
    ]]);
    
    //Establecer el punto de acuerdo a la info de la BD
/*     $map->modelCenter($model, 'mapcenter'); // set the map's center
    
    $map->modelZoom($model, 'mapzoom'); // set the map's zoom level

    $map->modelFeature($model, 'location'); // place a marker at the tower's location
 */
    //Permitir guardar
    $map->activeCenter($model, 'mapcenter'); // allow the map's center to be changed
    $map->activeZoom($model, 'mapzoom'); // allow the map's zoom level to be changed
    $map->activeMarker($model, 'location'); // allow the model's location to be changed

    $map->finder(); // add an interactive Search control to the map

    Locator::end();
?>
<div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        <a class="btn btn-outline-danger" href=<?= Url::to(['destinos/index']); ?>>Cancelar </a>
</div>

<?php ActiveForm::end(); ?>
</div>