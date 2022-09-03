
<?php
use yii\helpers\Html;
use app\models\Comentarios;
use app\models\Destinos;
?>
<!DOCTYPE html>
<html>
<head>
<style>
table {
  font-family: times, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

table td, th {
  border: 1px solid ;
  text-align: left;
  padding: 10px;
  height: 50px;  
}

th{
  text-align: center;
  background-color: #00FFFF;
  color: black;
}

tr:nth-child(even) {
  background-color: white;
}
</style>
</head>
<body>

<h3>REPORTE DE DESTINOS CON MEJORES COMENTARIOS EN EL SITIO WEB</h3>

<table>
  <tr>
    <th>EMISOR</th>
    <th>COMENTARIO</th>
    <th>DESTINO</th>
    <th>PUNTUACION</th>
  </tr>
  <tr>
    <td><?php foreach ($comentarios as $comentario): ?>  
        <div class="comments">                      
          <div class="info-comments">                
            <div class="header">
              <h5><?= Html::encode("{$comentario->nombre}") ?></h5>                    
            </div>

          </div>
      </div>
      <?php  endforeach; ?></td>
    <td><?php foreach ($comentarios as $comentario): ?>  
        <div class="comments">                      
          <div class="info-comments">                
            <div class="header">
              <h5><?= Html::encode("{$comentario->comentario}") ?></h5>                     
            </div>
          </div>
      </div>
      <?php  endforeach; ?></td>
    <td><?php foreach ($comentarios as $comentario): ?>  
        <div class="comments">                      
          <div class="info-comments">                
            <div class="header">                  
            </div>
          <?php foreach ($destinos as $destino): 
            if($destino->id == $comentario->destinos_id){?>
            <h5><?= Html::encode("{$destino->nombre}"); }?></h5>   
          <?php  endforeach; ?>
          </div>
      </div>
      <?php  endforeach; ?></td>
      <td><?php foreach ($comentarios as $comentario): ?>  
        <div class="comments">                      
          <div class="info-comments">                
            <div class="header"> 
              <h5><?= Html::encode("{$comentario->puntuacion}") ?></h5>                     
            </div>
          </div>
      </div>
      <?php  endforeach; ?></td>
</table>

<?php
if(empty($destino)){
  ?><div id="alert" class="alert alert-danger" role="alert">
      Ups! Parece que no hay comentarios para mostrar
    </div><?php
}?>


</body>
</html>

 



