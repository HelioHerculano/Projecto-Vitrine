<?php
    include('config.php');
    require_once 'core/init.php';
    ?>

<!DOCTYPE html>
<html>
    <head>
        <title>UP-VITRINE</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1,shrink-to-fit=no" > 
        <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="css/bootstrap-datepicker.css">
        <link rel="stylesheet" type="text/css" href="css/styleClear.css">
    </head>

    <body>



        <!--Modal-->
        <div class="modal fade" id="modalLogin" tabindex="-1" role="dialog" aria-labelledby="modalLoginTitulo" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title text-primary" id="modalLoginTitulo">Perfil do Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                
                <section class="bg-dark border-radius text-center text-white">

                <div class="text-white">
                <ul class="text-white list-unstyled pt-3">
                    <?php  $user = new User(); ?>
                    <li class="my-3"><b><?php echo strtoupper($user->data()->name); ?></b></li>
                    <li class="my-3"><b>Email: </b><?php echo ucfirst($user->data()->email); ?></li>
                    <li class="my-3"><b>Faculdade:</b><?php echo $user->data()->id_faculdade; ?></li>
                </ul>

                </div>
                <div class="py-4"><a class="btn btn-primary" href="perfil">Explorar</a></div>
        </section>

              </div>
            </div>
          </div>
    </div>
    <!--Fecha Modal-->
    



        <nav class="navbar navbar-light navbar-expand-md bg-primary fixed-top box-shadow" >
        
        <a class="text-white nav-link" href="home">LOGOMARCA</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            
            <ul class="navbar-nav ml-auto ">

            <li class="nav-item dropdown">
                <a class="text-white nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  VITRINES
                </a>
                <div class="hover-dark dropdown-menu bg-primary" aria-labelledby="navbarDropdown">
                    <?php

                        $faculdades =DB::getInstance()->query("SELECT * FROM faculdades");
                            if(!$faculdades->count()){
                                echo "Sem faculdades";
                            }else{

                                foreach ($faculdades->results() as $faculdade) {
                                $facul = strtolower($faculdade->id);
                                if($faculdade->id !="GERAL"){
                            echo "<a class='dropdown-item text-white' href='faculadeVitrine?id={$faculdade->id}'>{$faculdade->id}</a>";
                                }
                            
                            }
                         }
                    ?>
                </div>
              </li>

              <li class="nav-item">
                <a class="text-white nav-link" href="posts">PUBLICAÇÕES ANTIGAS</a>
              </li>

                <?php
                $user = new User();
                if(!$user->isLoggedIn() ){
                    if(isset($_SESSION['id'])){
                    echo '</li>
                    <li class="nav-item">
                    <a class="text-white nav-link btn-sm btn-dark mr-3" style="display:none"  href="subscribe">Manter - se conectado?</a>
                  </li>';
                 
                    }else{

                        echo '</li>
                    <li class="nav-item">
                    <a class="text-white nav-link btn-sm btn-dark mr-3"  href="subscribe">Manter - se conectado?</a>
                  </li>';

                    }

                    echo '<li class="nav-item">
                    <a class="text-white btn-sm btn-dark nav-link" href="login.php">LOGIN</a>';
                    
                }else{
             echo'      
            <li class="nav-item dropdown btn-sm btn-dark py-0">
                <a class="text-white nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  PAINEL
                </a>
                <div class="hover-dark dropdown-menu bg-primary" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item text-white" href="formCadastroFacul">Cadastrar Faculdade</a>   
                            <a class="dropdown-item text-white" href="novoAdmin">Novo Usúario</a>   
                            <a class="dropdown-item text-white " href="publicar">Publicar</a>   
                            <a class="dropdown-item text-white" href="listarFaculdade">Ver Faculdades</a>
                            <a class="dropdown-item text-white" href="relatorio.php">Relatorio</a>   
                            <a class="dropdown-item text-white" href="listarUsuario">Ver Usúarios</a> 
                            <a class="dropdown-item btn-perfil text-white btn btn-dark ml-md-0" data-toggle="modal" data-target="#modalLogin" href=""><p>PERFIL</p></a>   
                </div>
              </li>';
                
              
              
             echo '<li class="nav-item ">
                <a class="text-white btn btn-dark ml-md-3" href="logout.php">SAIR</a>
              </li>';
              }
                ?>
            </ul>

            
          </div>
    </nav>    

      <?php

            $url = isset($_GET['url']) ? $_GET['url'] : 'home';

        switch ($url) {
            case 'posts':
               include("{$url}.php");
            break;

            case 'login':
               header("Location: login.php");
            break;

            case 'formCadastroFacul':
                include("painel/{$url}.php");    
             break;


            case 'formCadastroActu':
                include("painel/{$url}.php");    
             break;


            case 'novoAdmin':
                include("painel/{$url}.php");    
             break;


            case 'publicar':
                include("painel/{$url}.php");    
             break;

             case 'perfil':
                include("painel/{$url}.php");    
             break;

            case 'listarUsuario':
                include("painel/{$url}.php");    
             break;


            case 'subscribe':
                include("painel/{$url}.php");    
             break;


            case 'listarFaculdade':
                include("painel/{$url}.php");    
             break;
             
             case 'sabermais':
                include("painel/{$url}.php");    
             break;

             case 'adicionarEvento':
                include("painel/{$url}.php");    
             break;

             case 'faculadeVitrine':
                include("painel/vitrine/{$url}.php");    
             break;

             case 'novaVitrine':
                include("painel/vitrine/{$url}.php");    
             break;

             case 'relatorio':
                header("Location: {$url}.php");    
             break;
        
            default:
            include("{$url}.php");
        }

        ?>

              

<footer class="bg-dark text-white rodape rodape">
        <div class="container py-4">
            <div class="row">
                <div class="col-md-6 col-6">
                    <h4 class="h6">SOBRE A UNIVERSIDADE</h4>
                    <p class="text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero, tempora culpa nostrum, incidunt illum doloremque accusantium, veritatis recusandae voluptatibus fugiat iusto! Non nam iure dolorem debitis, nostrum, eaque voluptate porro.</p>
                </div>
                <div class="col-md-4">
                    <h4 class="h6">DADOS DE CONTACTO</h4>
                    <ul class="list-unstyled text-secondary">
                        <li>Universidadepedagogica@up.com.mz</li>
                        <li>(+258) 84 20 45 773</li>
                        <li>De Seg. à sex. das 8h às 21h</li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <h4 class="h6">REDES SOCIAIS</h4>
                    <ul class="list-unstyled">
                        <li><a class="btn btn-outline-secondary btn-block btn-sm mb-2" href="" style="max-width: 140px">Facebook</a></li>
                        <li><a class="btn btn-outline-secondary btn-block btn-sm mb-2" href="" style="max-width: 140px">Twiter</a></li>
                        <li><a class="btn btn-outline-secondary btn-block btn-sm mb-2" href="" style="max-width: 140px">Instagram</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="bg-primary text-center py-3">
            <p class="mb-0">258TECH © 2021. Alguns direitos reservados.</p>
        </div>
    </footer>
    
    <script src="../../js/min-perfil.js" ></script>
    <script type="text/javascript" src="js/jquery-3.2.1.slim.min.js"></script>
    <script type="text/javascript" src="js/popper.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/app.js"></script>
           
    
    </body>
</html>

