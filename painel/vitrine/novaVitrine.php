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

            $validate = new Validate();
            $validation = $validate->check($_POST, [

                'username' => [
                    'required' => true,
                    'min' => 2,
                    'max' => 20,
                    'unique' => 'users'
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
                'password_again' => [
                    'required' => true,
                    'matches' => 'password'
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
                
                try{

                    $user->create([
                        'username' => Input::get('username'),
                        'password' => Hash::make(Input::get('password'), $salt),
                        'salt' => $salt,
                        'name' => Input::get('name'),
                        'joined' => date('Y-m-d H:i:s'),
                        'email' => Input::get('email'),
                        'id_faculdade' => Input::get('faculdade'),
                        'group' => 2
                    ]);

                 Session::flash('home', 'You have been registered and can now login');
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

    }




?>

<section class=" bg-white py-5">
    <div class="container">
        <div class="row bg-light box-shadow border-radius">
            <div class="col-12 text-center py-5">

<h1 class="display-4 text-primary mb-3">Nova Vitrine</h1>
<form method="POST" action="" class="form mx-auto" enctype="multipart/form-data">

   
                    <label class="label-input" for="">
                        <i class="far fa-user icon-modify"></i>
                        <input type="text" name="vitrine" placeholder="Vitrine" disabled="true" value='<?php echo "{$_GET['id']}";?>'> 
                    </label>

                    <label class="label-input" for="">

                    <i class="fas fa-graduation-cap"></i>
                        <select class="select"  name="faculdade" id="">
                            <option value="">SELECT</option> 
                            <option value=""><?php echo "{$_GET['id']} 1";?></option> 
                            <option value=""><?php echo "{$_GET['id']} 2";?></option> 
                        </select>
                    </label>
                    
                    
                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                    <input class="btn btn-primary btn-lg" type="submit" value="Cadastrar" name="novoAdmin">
                </form>

            </div>
        </div>
    </div>
</section>

<?php 
    }
?>