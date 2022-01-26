<?php  
    include('config.php');
    require_once 'core/init.php';
 ?>

<!DOCTYPE html>
<html lang="pt-Br">
<head>
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>css/bootstrap.css">    
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>css/style.css">    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UP-VITRINE | LOGIN</title>
</head>
<body>

<base base="<?php echo INCLUDE_PATH; ?>" />


<?php

	if(Input::exists()){
        
		if(Token::check(Input::get('token'))) {

			$validate = new Validate();
			$validation = $validate->check($_POST,[

				'username' => ['required' => true],
				'password' => ['required' => true]

			]);

			if($validation->passed()){

				$user = new User();

				$remember = (Input::get('remember') === 'on') ? true : false;
				$login = $user->login(Input::get('username'),Input::get('password'), $remember);
                Session::put('senha',Input::get('password'));
				if($login){
					Redirect::to('index.php');
				}else{

                    if(Session::exists('aviso')){
                     echo Session::flash('aviso');
                    }

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

    
    <div class="container">
        <div class="content first-content">
            <div class="first-column">

                <h2 class="title title-primary">Seja Bem Vindo</h2>
                <p class="description description-primary">Para se manter conectado</p>
                <p class="description description-primary">porfavor faça o login agora! </p>
                <button id="entrar" class="btn btn-primary" >Entrar</button>

            </div><!--first-colum-->

            <div class="second-column">

                <h2 class="title title-second mb-4">Instruções</h2>

                <p class="px-5">tetur adipisicing elit. Molestiae cupiditate placeat obcaecati dolore consequatur excepturi eaque quae soluta, iste, ratione voluptatibus est aut? Totam odio error, tempore exercitationem architecto iste!S</p>

                <ul>
                    <li>Lorem ipsum dolor sit amet consec</li>
                    <li>Lorem ipsum dolor sit amet consec</li>
                    <li>Lorem ipsum dolor sit amet consec</li>
                    <li>Lorem ipsum dolor sit amet consec</li>
                </ul>

            </div><!--second-colum-->
        </div><!--content first-content-->



        <div class="content second-content">

            <div class="first-column">

                <h2 class="title title-primary">Como vai amigo?</h2>
                <p class="description description-primary">Intrduza os seus dados pessoais</p>
                <p class="description description-primary">e disfrute dos nosso sistema</p>
                

            </div><!--first-colum-->

            <div class="second-column">

                <h2 class="title title-second">Login</h2>

                <div class="social-media">
                    <ul  class="list-social-media">
                        <a class="link-social-media" href="#">
                            <li class="item-social-media">
                                <i class="fab fa-facebook-f"></i>
                            </li>
                        </a>
                        <a class="link-social-media" href="#">
                            <li class="item-social-media">
                                <i class="fab fa-google-plus-g"></i>
                            </li>
                        </a>
                        <a class="link-social-media" href="#">
                            <li class="item-social-media">
                                <i class="fab fa-linkedin-in"></i>
                            </li>
                        </a>
                    </ul>
                </div><!--social-media-->
                <p class="description description-second">Ou use  seu email</p>

                <form method="POST" class="form">
                    
                    <label class="label-input" for="">
                        <i class="far fa-envelope icon-modify"></i>
                        <input type="text" name="username" placeholder="E-mail"> 
                    </label>
                    
                    <label class="label-input" for="">
                        <i class="fas fa-lock icon-modify"></i>
                        <input type="password" name="password" placeholder="Password">
                    </label>
                    
                    <a class="passward" href="">Esqueceu a sua senha?</a>

                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                    <input class="btn btn-second" type="submit" name="entrar" value="Entrar">
                </form>

            </div><!--second-colum-->

        </div><!--content second-content-->
    </div><!--container-->
    <script src="https://kit.fontawesome.com/519d4355c7.js" crossorigin="anonymous"></script>
    <script src="js/app.js" ></script>
</body>
</html>