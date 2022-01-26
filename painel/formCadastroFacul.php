<?php

if(!$user->isLoggedIn() ) {

    Redirect::to('home');

     Session::flash('home', '<script type="text/javascript">
            alert("Não pode aceder a essa pagina");
        </script>');
} else {

    if(Input::exists()){
        
        if(Token::check(Input::get('token'))) {

            $validate = new Validate();
            $validation = $validate->check($_POST,[

                'nome' => ['required' => true],
                'sigla' => ['required' => true],
                'email' => ['required' => true],
                'contacto' => ['required' => true],
                'descricao' => ['required' => true]

            ]);

            $faculdade = new Faculdade();

            if($validation->passed()){

                try{

                     $faculdade -> create([

                            'id' => Input::get('sigla'),
                            'nome' => Input::get('nome'),
                            'email' => Input::get('email'),
                            'contacto' => Input::get('contacto'),
                            'descricao' => Input::get('descricao')

                        ]);
                
                    Session::flash('sucesso', 'Faculdade registada co sucesso');
                    //Redirect::to('index.php');
                    if(Session::exists('sucesso')){
                        echo '<p>'.Session::flash('sucesso').'</p>';
                    }

                }catch(Exception $e){
                    die($e->getMessage());
                }
            }else{
                foreach($validation->errors() as $error){
                    echo "<div style='text-align: center' class='alert alert-warning' role='alert'>
                      {$error}
                    </div>"; 
                }
            }
        }

    }


?>

<section class=" bg-white py-5">
    <div class="container">
        <div class="row bg-light box-shadow border-radius">
            <div class="col-12 text-center py-5">


                <h1 class="display-4 text-primary mb-3">Dados da faculdade</h1>
      

                <form method="POST" action="" class="form mx-auto">
                    <label class="label-input" for="">
                        <i class="far fa-user icon-modify"></i>
                        <input type="text" name="nome" placeholder="Name"> 
                    </label>

                    <label class="label-input" for="">
                        <i class="far fa-envelope icon-modify"></i>
                        <input type="text" name="sigla" placeholder="Sigla"> 
                    </label>
                    
                    <label class="label-input" for="">
                        <i class="far fa-envelope icon-modify"></i>
                        <input type="email" name="email" placeholder="E-mail"> 
                    </label>

                    <label class="label-input" for="">
                        <i class="far fa-envelope icon-modify"></i>
                        <input type="text" name="contacto" placeholder="Contacto"> 
                    </label>
                    
                    <label class="label-input" for="">
                    <textarea name="descricao" id="" cols="30" rows="10" placeholder="Descrição"></textarea>
                    </label>
                    
                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                    <input class="btn btn-primary btn-lg" type="submit" value="Cadastrar" name="cadFacul">
                </form>

                </div>
        </div>
    </div>
</section>

<?php
    }
?>


        