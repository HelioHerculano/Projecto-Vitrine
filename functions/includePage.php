<?php

	function AddPage($page){

		$url = isset($page) ? $page : 'home';

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
             

             case 'relatorio':
                header("Location: {$url}.php");    
             break;
        
            default:
            include("{$url}.php");
        }



	}

?>