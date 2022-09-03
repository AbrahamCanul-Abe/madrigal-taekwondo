<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Destinos */

$this->title = Yii::t('app', 'Destinos');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Destinos'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="destinos-create container">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
