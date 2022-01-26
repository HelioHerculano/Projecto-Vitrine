<?php
    require_once 'core/init.php';

    if(Input::exists()){
        if(Token::check(Input::get('token'))) {

            $validate = new Validate();
            $validation = $validate->check($_POST,[

                'name' => ['required' => true],
                'email' => ['required' => true]

            ]);

            if($validation->passed()){

                $visitante = new Visitante();

                $remember = (Input::get('remember') === 'on') ? true : false;
                //$subscribe = $visitante->subscribe($remember);

                //$visitante->find(Input::get('email'));

                //echo $visitante->data()->nome;
               if($visitante->subscribe(['nome' => Input::get('name'),'email'=>Input::get('email')])){
                    $visitante->subscribeSession(Input::get('email'),$remember);
                    Redirect::to('index.php');
                }

                /*if($login){
                    Redirect::to('index.php');
                }else{
                    echo "<p>Login Falhou</p>";
                }*/

            }else{
                foreach($validation->errors() as $error){
                    echo $error. '</br>'; 
                }
            }

        }
    }

?>
