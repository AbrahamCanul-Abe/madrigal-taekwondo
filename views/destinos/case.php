<?php use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class='container'>
    <br>
    <br>
    <br>
    <br>
    <br>
    <h1 class="bg-danger">Error al eliminar destino</h1>
    <br>
<?php
if(!empty($multi) && !empty($geo)){
    ?> <h1>Si desea eliminar el destino "<?= Html::encode($model->nombre)?>", verifique que los datos de la geolocalizacion y multimedia correspondiente esten eliminados con anteoridad</h1>
        <div class='container text-center'>
    <a class="btn btn-outline-danger" href=<?= Url::to(['multimedia/index']); ?>>ir a multimedia</a>
    <a class="btn btn-outline-danger" href=<?= Url::to(['destinos/index']); ?>>regresar</a>
    </div>
    <?php
}
else if(!empty($geo)){
    ?> <h1>Si desea eliminar el destino "<?= Html::encode($model->nombre)?>", verifique que los datos de geolocalizacion que pertenezcan al destino esten eliminados con anteoridad</h1>
        <div class='container text-center'>
    <a class="btn btn-outline-danger" href=<?= Url::to(['destinos/index']); ?>>regresar</a>
    </div>
    <?php
}
else if(!empty($multi)){
    ?> <h1>Si desea eliminar el destino "<?= Html::encode($model->nombre)?>", verifique que los datos de multimedia que pertenezcan al destino esten eliminados con anteoridad</h1>
    <div class='container text-center'>
    <a class="btn btn-outline-danger" href=<?= Url::to(['multimedia/index']); ?>>ir a multimedia</a>
    <a class="btn btn-outline-danger" href=<?= Url::to(['destinos/index']); ?>>regresar</a>
    </div>
    <?php
    
}

?>
</div>