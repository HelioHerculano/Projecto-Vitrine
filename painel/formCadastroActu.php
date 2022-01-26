<?php

if(!$user->isLoggedIn() ) {

    Redirect::to('home');

     Session::flash('home', '<script type="text/javascript">
            alert("Não pode aceder a essa pagina");
        </script>');
} else {

    $faculdade = new Faculdade($_GET['cod']);
    $id = $_GET['cod'];
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

            if($validation->passed()){
                
                try{

                     $faculdade->update([

                             'nome'=>Input::get('nome'),
                             'email'=>Input::get('email'),
                             'contacto'=>Input::get('contacto'),
                             'descricao'=>Input::get('descricao')

                        ]);
                        


                            /* echo Input::get('nome');
                             echo Input::get('email');
                             echo Input::get('contacto');
                             echo Input::get('descricao');*/

                    Session::flash('sucesso', 'Faculdade actualizada com sucesso');
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

    //$db = new DB; 
   //$f = $db->action('SELECT *','faculdades',['id', '=' ,$_GET['cod']]);


?>

<section class=" bg-white py-5">
    <div class="container">
        <div class="row bg-light box-shadow border-radius">
            <div class="col-12 text-center py-5">


                <h1 class="display-4 text-primary mb-3">Dados da faculdade</h1>
      

                <form method="POST" action="" class="form mx-auto">
                    <label class="label-input" for="">
                        <i class="far fa-user icon-modify"></i>
                        <input type="text" name="nome" placeholder="Name" value="<?php echo $faculdade->data()->nome; ?>"> 
                    </label>

                    <label class="label-input" for="">
                        <i class="far fa-envelope icon-modify"></i>
                        <input type="text" name="sigla" placeholder="Sigla" value="<?php echo $faculdade->data()->id; ?>" > 
                    </label>
                    
                    <label class="label-input" for="">
                        <i class="far fa-envelope icon-modify"></i>
                        <input type="email" name="email" placeholder="E-mail" value="<?php echo $faculdade->data()->email; ?>" > 
                    </label>

                    <label class="label-input" for="">
                        <i class="far fa-envelope icon-modify"></i>
                        <input type="text" name="contacto" placeholder="Contacto" value="<?php echo $faculdade->data()->contacto; ?>" > 
                    </label>
                    
                    <label class="label-input" for="">
                    <textarea name="descricao" id="" cols="30" rows="10" placeholder="Descrição"><?php echo $faculdade->data()->descricao; ?></textarea>
                    </label>
                    
                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                    <input class="btn btn-primary btn-lg" type="submit" value="Actualizar" name="cadFacul">
                </form>

                </div>
        </div>
    </div>
</section>

<?php
    }
?>


        