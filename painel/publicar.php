<?php

          if(!$user->isLoggedIn() ) {

    Redirect::to('home');

     Session::flash('home', '<script type="text/javascript">
            alert("Não pode aceder a essa pagina");
        </script>');
} else {

    if(Input::exists()){
        if(Token::check(Input::get('token'))){

            //echo "dentro";

                $publicacao = new Publicacao();
                
                try{

                   if($publicacao->uploadArquivos(Input::get('faculdade'))){
                    $publicacao->sobreArquivo(Input::get('titulo'),Input::get('assunto'));
                   }
                   

                 Session::flash('home', 'Publicação feita com sucesso');
                 //Redirect::to('index.php');
                 if(Session::exists('home')){
                        echo '<p>'.Session::flash('home').'</p>';
                    }

                }catch(Exception $e){
                    die($e->getMessage());
                }

        }

    }

?>
<div class="container">
    <div class="row">
        <div class="col-6">
            <a href="adicionarEvento" class="btn btn-outline-secondary">PUBLICAR EVENTO</a>            
        </div>
    </div>
</div>


<section class=" bg-white py-5">
    <div class="container">
        <div class="row bg-light box-shadow border-radius">
            <div class="col-12 text-center py-5">

<h1 class="display-4 text-primary mb-3">Publicar</h1>
<form method="POST" action="" class="form mx-auto" enctype="multipart/form-data">

      
                 
  <div class="custom-file py-5">
  <input type="file" class="custom-file-input" id="customFile" name="arquivo">
  <label class="custom-file-label" for="customFile">Choose file</label>
</div>


   
                    <label class="label-input" for="">
                        <i class="far fa-user icon-modify"></i>
                        <input type="text" name="titulo" placeholder="Titulo do assunto"> 
                    </label>

                    <label class="label-input" for="">
                    <textarea name="assunto" id="" cols="30" rows="10" placeholder="Corpo do assunto"></textarea>
                    </label>

                    <label class="label-input" for="">
                    <i class="fas fa-graduation-cap"></i>
                        <select class="select"  name="faculdade" id="">
                            <option value="">SELECT</option> 
                            <option name='faculdade'>GERAL</option> 
                            <?php 

                            $faculdades =DB::getInstance()->query("SELECT * FROM faculdades");
                            if(!$faculdades->count()){
                                echo "Sem faculdades";
                            }else{

                                foreach ($faculdades->results() as $faculdade) {
                                 echo " <option name='faculdade'> {$faculdade->id} </option> ";
                                } 


                            }
                      
                          ?>
                        </select>
                    </label>
                    
                    
                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                    <input class="btn btn-primary btn-lg" type="submit" value="Publicar" name="publicar">
                </form>

            </div>
        </div>
    </div>
</section>

<?php
    }
?>