<?php
use app\models\Geolocation;
use app\models\Destinos;
use app\models\Multimedia;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\db\query;

?>
                                                                                                                                                                                                                                                                                                        
        <div class="col">     
          <div class="card" style="width: 18rem;">
            
            <div class="card-body">
              <h5><?= Html::encode($Titulo) ?></h5>
              <img src="<?= Yii::getAlias('@web');?> /upload/multimedia/<?= Html::encode($Foto)?>" class="card-img-top" alt="..." width="200" height="150">                                                                            
              <p class="card-text" id="description"><?= Html::encode($Descripcion) ?></p>              
              <a style="color: white;" href=<?= Url::to(['site/destinodetallado','id_destino' => $id_des]);?> class="btn btn-primary">Más sobre este sitio</a>
              <a style="color: white;" href="#" class="btn btn-primary">Ir aqui</a>
            </div>
          </div>
        </div>
