<?php

use yii\helpers\Url;

?>


    <footer>

          <img src="../img/logo.png" alt="" width="100" height="100">
          <h2 id="azul">Síguenos en Nuestras Redes Sociales</h2>
         <span class='fa-stack fa-2x'>
            <i class='fa fa-circle fa-stack-2x'></i>
            <a href="https://www.facebook.com/TecNMCampusValladolid" class='fab fa-facebook-f fa-stack-1x fa-inverse' style="text-decoration: none;"></a>
          </span>
          <span class='fa-stack fa-2x'>
              <i class='fa fa-circle fa-stack-2x'></i>
              <a class='fab fa-twitter fa-stack-1x fa-inverse' href="https://twitter.com/TecnmValladolid" style="text-decoration: none;"></a>
            </span>
            <span class='fa-stack fa-2x'>
              <i class='fa fa-circle fa-stack-2x'></i>
              <a class='fab fa-instagram fa-stack-1x fa-inverse' href="https://www.instagram.com/tecnmvalladolid/" style="text-decoration: none;"></a>
            </span>
            <span class='fa-stack fa-2x'>
              <i class='fa fa-circle fa-stack-2x'></i>
              <a class='fab fa-youtube fa-stack-1x fa-inverse' href="https://www.youtube.com/channel/UCno9ygktbNgseAxzn-ugVNQ" style="text-decoration: none;"></a>
            </span>

        <div class="container-footer">
                    <div class="copyright">
                        © 2022 Todos los Derechos Reservados  <a href=""></a>
                    </div>

                    <div class="information">
                         <a href=<?= url::to(['../web/site/politica_privacidad']);?>>Politicas y privacidad</a> | <a href=<?= url::to(['../web/site/terminos_condiciones']);?>>Terminos y Condiciones</a>| <a href=<?= url::to(['../web/site/acerca_de']);?>>Acerca de</a>
                    </div>
                </div>
              </div>
       </footer>
  <script>
        AOS.init();
    </script>