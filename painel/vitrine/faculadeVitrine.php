<?php

  $publicacao = new Publicacao();

  $arquivos = $publicacao->getPublicacaoArquivo();

        $i=0;$urls = [];$titulos=[];$ids=[];
          foreach($publicacao->getPublicacaoArquivo()->results() as $key => $arquivo ) {
                if($arquivo->id_faculdade == $_GET['id']){
                    $urls[$i] = $arquivo->url;
                    $titulos[$i] = $arquivo->titulo;  
                    //$titlos[$i] = $arquivo->titulo;  
                    $ids[$i] = $arquivo->id;
                    $i++;  
                }
              }
?>
<section class=" bg-white py-5">
  <h1 class="display-5 text-primary text-center mb-5" >VITRINE - <?php echo $_GET['id']; ?></h1>
  
<div class="container">
    <div class="row">
        <div class="col-9">
            <a href="publicar" class="btn btn-outline-secondary mb-3"><?php echo "{$_GET['id']} 2";?></a>            
            <a href="publicar" class="btn btn-outline-secondary mb-3"><?php echo "{$_GET['id']} 3";?></a>            
        </div>


        <div class="col-3" >
          <a href='<?php echo "novaVitrine?id= {$_GET['id']}";?>' class="btn btn-secondary mb-3 m-0">Nova vitrine</a>  
        </div>
    </div>
</div>


    <div class="container">
        <div class="row bg-light box-shadow border-radius">
            <div class="col-12 text-center py-5">

<div class="row bg-dark text-white" >

          <div class="col-lg-12 p-0">
              
            <div id="carouselCidades" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <?php

                foreach($urls as $key => $arquivo ) {
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

              foreach($urls as $key => $url ) {
                
                  if($key==0){
                    
                    echo "<div class='carousel-item active'>";
                    echo "<img class='d-block w-100' src='{$url}' alt='Clifornia'>";
                    echo '<div class="carousel-caption">';
                      echo  "<h3 class='display-4 text-primary' >{$titulos[$key]}</h3>";
                      echo "<a class='btn btn-outline-primary' href='sabermais?id={$ids[$key]}'>Saber Mais</a>";
                      echo '</div>';
                      echo '</div>';
                    }else{
                      echo "<div class='carousel-item'>";
                      echo "<img class='d-block w-100' src='{$url}' alt='Clifornia'>";
                      echo '<div class="carousel-caption">';
                        echo  "<h3 class='display-4 text-primary' >{$titulos[$key]}</h3>";
                        echo "<a class='btn btn-outline-primary' href='sabermais?id={$ids[$key]}'>Saber Mais</a>";
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

         
      </div>


          </div>
        </div>
    </div>
</section>
    
<section class="container ">

  <div class="row text-center">

    <div class="col">


    <p class="lead" >FIQUE ATENTO AOS PROXIMOS EVENTOS DA FACULDADE</p>
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

      if($evento->faculdade == $_GET['id']){

      echo"<tr>
        <td>{$evento->assunto}</td>
        <td>{$evento->data}</td>
        <td>{$evento->hora}</td>
        <td>{$evento->local}</td>
        <td><a class='btn btn-outline-secondary btn-sm' href=''>Interessado</a></td>
      </tr>";

      }
    }
    ?>
  </tbody>
</table>
       </div>
    </div>
  </section>