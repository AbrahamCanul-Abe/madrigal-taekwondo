<?php use yii\helpers\Html;
use yii\helpers\Url;
?>
<div class='container'>
    <br>
    <br>
    <br>
    <br>
    <br>
    <h1 class="bg-danger">Error al eliminar Empresa</h1>
    <br>
<?php
if(!empty($desti)){
    ?> <h1>Si desea eliminar la empresa "<?= Html::encode($model->nombre)?>", verifique que los datos de los destinos que pertenezcan a la empresa esten eliminados con anteoridad</h1>
        <div class='container text-center'>
    <a class="btn btn-outline-danger" href=<?= Url::to(['destinos/index']); ?>>Ir a destinos</a>
    <a class="btn btn-outline-danger" href=<?= Url::to(['empresa/index']); ?>>Regresar</a>
    </div>
    <?php
}
?>