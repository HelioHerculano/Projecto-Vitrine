
<?php


  $publicacao = new Publicacao();

  $arquivos = $publicacao->getPublicacaoArquivo();

?>

<section class=" bg-white py-5">
  <h1 class="display-5 text-primary text-center mb-5" >PUBLICAÇÃO</h1>
    <div class="container">
        <div class="row bg-light box-shadow border-radius">
            <div class="col-12 text-center py-5">

<div class="row bg-dark text-white" >

          <div class="col-lg-12 p-0">
              
            <div id="carouselCidades" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">

                 <div class='carousel-item active'>
                  <?php
                  foreach($publicacao->getPublicacaoArquivo()->results() as $key => $arquivo ) {
                    if($arquivo->id == $_GET['id']){
                      echo "<img class='d-block w-100' src='{$arquivo->url}' alt='Clifornia'>";
                    ?>
                   
                 </div>
                     
              </div>
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

    <?php
    echo "<p class='lead mb-2' >{$arquivo->titulo}</p>";
    
    echo "<p class='mb-5'>{$arquivo->assunto}</p>";

    }
  }

  ?>
 
       </div>
    </div>
  </section>