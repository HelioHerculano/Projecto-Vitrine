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

                   
                    $publicacao->publicarEventos([
                                                    "data" => Input::get('data_evento'),
                                                    "hora" => Input::get('hora_evento'),
                                                    "local" => Input::get('local'),
                                                    "assunto" => Input::get('assunto'),
                                                    "faculdade" => Input::get('faculdade')
                                                ]);
                   
                   

                 Session::flash('home', 'Evento marcado');
                 //Redirect::to('index.php');
                 if(Session::exists('home')){
                        echo '<p>'.Session::flash('home').'</p>';
                    }

                   // echo Input::get('data_evento');
                  //  echo Input::get('hora_evento');

                }catch(Exception $e){
                    die($e->getMessage());
                }

        }

    }

?>


<div class="container">
    <div class="row">
        <div class="col-6">
            <a href="publicar" class="btn btn-outline-secondary">PUBLICAR ARQUIVOS</a>            
        </div>
    </div>
</div>


<section class=" bg-white py-5">
    <div class="container">
        <div class="row bg-light box-shadow border-radius">
            <div class="col-12 text-center py-5">

<h1 class="display-4 text-primary mb-3">Publicar Evento</h1>
<form method="POST" action="" class="form mx-auto" enctype="multipart/form-data">

   
                    <span class="label-input mb-3 mr-5" for="">
                        
                        <label for="date" class="mr-3 lead  text-secudary">Data</label>
                        <Input class="mr-5 btn btn-outline-secondary btn-lg" type="date" id="date" name="data_evento"/>
                        <label for="date" class="mr-3 lead  text-secudary">Hora</label> 
                        <Input class="ml-0 btn btn-outline-secondary btn-lg" type="time" name="hora_evento"/> 

                    </span>

                    <label class="label-input" for="">
                        <i class="far fa-user icon-modify"></i>
                        <input type="text" name="assunto" placeholder="Assunto"> 
                    </label>

                    <label class="label-input" for="">
                        <i class="far fa-user icon-modify"></i>
                        <input type="text" name="local" placeholder="Local do evento"> 
                    </label>

                    <label class="label-input" for="">
                    <i class="fas fa-graduation-cap"></i>
                        <select class="select"  name="faculdade" id="">
                            <option value="">VITRINE</option> 
                            <option name="faculdade">GERAL</option> 
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