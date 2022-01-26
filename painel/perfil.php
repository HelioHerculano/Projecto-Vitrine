<?php

//$user = new User();


if(!$user->isLoggedIn() ) {

 Redirect::to('home');

Session::flash('home', '<script type="text/javascript">
            alert("Não pode aceder a essa pagina");
        </script>');
} else {


    
    /*if(Input::exists()){
        if(Token::check(Input::get('token'))){

            //echo "dentro";

            $validate = new Validate();
            $validation = $validate->check($_POST, [

                'username' => [
                    'required' => true,
                    'min' => 2,
                    'max' => 20
                ],
                'name' => [
                    'required' => true,
                    'min' => 2,
                    'max' => 50
                ],
                'password' => [
                    'required' => true,
                    'min' => 6
                ],
                'new_password' => [
                    'min' => 6,
                    'NOTmatches' => 'password'
                ],
                'password_again' => [
                    'matches' => 'new_password'
                ],
                'faculdade' => [
                    'required' => true
                ],
                'email' => [
                    'required' => true
                ]

            ]);

            if( $validation->passed() ){
                
                //Session::flash('success','Your registered successfully!');
                //header('Location: index.php');

                $user = new User();

                 $salt = Hash::salt(32);

                 if(Input::get('new_password') != null){
                        $Password = Hash::make(Input::get('new_password'), $salt);                        }else{
                         $password = Hash::make(Input::get('password'), $salt);
                        }
                
                try{

                    $user->update([
                        'username' => Input::get('username'),
                        'password' => $password,
                        'salt' => $salt,
                        'name' => Input::get('name'),
                        'joined' => date('Y-m-d H:i:s'),
                        'email' => Input::get('email'),
                        'id_faculdade' => Input::get('faculdade'),
                        'group' => 2
                    ]);

                 Session::flash('home', 'Dados actualizados com sucesso');
                 //Redirect::to('index.php');
                 if(Session::exists('home')){
                        echo '<p>'.Session::flash('home').'</p>';
                    }

                }catch(Exception $e){
                    die($e->getMessage());
                }

            }else{
                //output errors
                foreach ($validation->errors() as $error) {
                    echo "{$error} <br>";           }
            }

        }

    }*/

    if(Input::exists()){
    if(Token::check(Input::get('token'))) {

        $validate = new Validate();
            $validation = $validate->check($_POST, [

                'username' => [
                    'required' => true,
                    'min' => 2,
                    'max' => 20
                ],
                'name' => [
                    'required' => true,
                    'min' => 2,
                    'max' => 50
                ],

                'email' => [
                    'required' => true
                ]

            ]);

        if($validation->passed()){
            //update

            try{

                //echo Input::get('name');
                $user->update([
                    'username' => Input::get('username'),
                    'name' => Input::get('name'),
                    'email' => Input::get('email'),
                    'id_faculdade' => Input::get('faculdade')
                ]);

                Session::flash('home','Dados actualizados');
                 if(Session::exists('home')){
                    echo Session::flash('home');
                }
                ///Redirect::to('index.php');

                
            }catch(Exception $e){
                die($e->getMessage());
            }

        }else{
            foreach($validation->errors() as $error){
                echo $error. '<br>';
            }
        }

    }
}

?>

<section class=" bg-white py-5">
    <div class="container">
        <div class="row bg-light box-shadow border-radius">
            <div class="col-12 text-center py-5">


                <h1 class="display-4 text-primary mb-3">Dados do Usúario</h1>
      

                <form method="POST" action="" class="form mx-auto">
                    <label class="label-input" for="">
                        <i class="far fa-user icon-modify"></i>
                        <input type="text" name="username" placeholder="Nome do Usuario" value="<?php echo $user->data()->username ?>"> 
                    </label>

                    <label class="label-input" for="">
                        <i class="far fa-user icon-modify"></i>
                        <input type="text" name="name" placeholder="Nome Proprio" value="<?php echo $user->data()->name ?>"> 
                    </label>

                    <label class="label-input" for="">
                    <i class="far fa-user icon-modify"></i>
                    <input type="email" name="email" placeholder="E-mail" value="<?php echo $user->data()->email ?>"> 
                    </label>

                    <label class="label-input" for="">
                    <i class="fas fa-graduation-cap"></i>
                        <select class="select"  name="faculdade" id="">
                            <option value=""><?php $user = new User(); echo $user->data()->id_faculdade; ?></option> 
                            <?php 

                            $faculdades =DB::getInstance()->query("SELECT * FROM faculdades");
                            if(!$faculdades->count()){
                                echo "Sem faculdades";
                            }else{

                                foreach ($faculdades->results() as $faculdade) {
                                    if( $user->data()->id_faculdade != $faculdade->id){
                                        echo " <option name='faculdade'> {$faculdade->id} </option> ";
                                    }
                                } 


                            }
                      
                          ?>
                        </select>
                    </label>
                    
                    <a href="changePassword.php">Aterar a Senha</a>
                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                    <input class="btn btn-primary btn-lg" type="submit" value="Actualizar" name="novoAdmin">
                </form>

                </div>
        </div>
    </div>
</section>

<?php 
}
?>