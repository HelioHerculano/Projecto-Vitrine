<?php

  $publicacao = new Publicacao();

  $arquivos = $publicacao->getPublicacaoArquivo();

?>
<section class=" bg-white py-5">
    <div class="container">
        <div class="row bg-light box-shadow border-radius">
            <div class="col-12 text-center py-5">

<div class="row bg-dark text-white" >

          <div class="col-lg-7 p-0">
              
            <div id="carouselCidades" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <?php

                foreach($publicacao->getPublicacaoArquivo()->results() as $key => $arquivo ) {
                  if($key == 0){
                  echo "<li data-target='#carouselCidades' data-slide-to='{$key}' class='active'></li>";
                  }else{
                  echo "<li data-target='#carouselCidades' data-slide-to='{$key}'></li>";
                  }
                }

                ?>
              </ol>
              <div class="carousel-inner">

              <?php

              foreach($publicacao->getPublicacaoArquivo()->results() as $key => $arquivo ) {
                if($key==0){
                echo "<div class='carousel-item active'>";
                echo "<img class='d-block w-100' src='{$arquivo->url}' alt='Clifornia'>";
                echo '<div class="carousel-caption">';
                  echo  "<h3 class='display-4 text-primary' >{$arquivo->titulo}</h3>";
                  echo "<a class='btn btn-outline-primary' href='sabermais?id={$arquivo->id}'>Saber Mais</a>";
                  echo '</div>';
                  echo '</div>';
                }else{
                  echo "<div class='carousel-item'>";
                  echo "<img class='d-block w-100' src='{$arquivo->url}' alt='Clifornia'>";
                  echo '<div class="carousel-caption">';
                    echo  "<h3 class='display-4 text-primary' >{$arquivo->titulo}</h3>";
                    echo "<a class='btn btn-outline-primary' href='sabermais?id={$arquivo->id}'>Saber Mais</a>";
                  echo '</div>';
                  echo '</div>';
                }
            }
            ?>
                    
                     
              </div>
              <a class="carousel-control-prev" href="#carouselCidades" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Anterior</span>
              </a>
              <a class="carousel-control-next" href="#carouselCidades" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Proximo</span>
              </a>
            </div>

          </div>

          <div class="col-lg-5 p-4 align-self-center">
              <h1 class="display-4" >Fique Sempre Conectado a Vitrine</h1>
              <p class="lead" >Neste espaço traremos sempre informações de extrema importancia para ti</p>
              <form>  
                    <textarea class="form-control" placeholder="Alguma duvida?"></textarea>
                   
                    <button class="btn btn-primary mt-2" type="button">Enviar duvida</button>
              </form>
          </div>
      </div>


          </div>
        </div>
    </div>
</section>
    
<section class="container ">

  <div class="row text-center">

    <div class="col">


    <p class="lead" >FIQUE ATENTO AOS PROXIMOS EVENTOS DA UNIVERSIDADE</p>
    <h1 class="display-5 text-primary" >PROXIMOS EVENTOS</h1>

      <table class="table table-hover my-5">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Assunto/Evento</th>
      <th scope="col">Data</th>
      <th scope="col">Hora</th>
      <th scope="col">Local</th>
      <th scope="col">Demostrar interesse</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach($publicacao->getEvent()->results() as $key => $evento ) {
      echo"<tr>
        <td>{$evento->assunto}</td>
        <td>{$evento->data}</td>
        <td>{$evento->hora}</td>
        <td>{$evento->local}</td>
        <td><a class='btn btn-outline-secondary btn-sm' href=''>Interessado</a></td>
      </tr>";
    }
    ?>
  </tbody>
</table>
       </div>
    </div>
  </section>