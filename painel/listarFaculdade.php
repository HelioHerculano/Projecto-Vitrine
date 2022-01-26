<?php

 if(!$user->isLoggedIn() ) {

    Redirect::to('home');

     Session::flash('home', '<script type="text/javascript">
            alert("Não pode aceder a essa pagina");
        </script>');
} else {

?>

<section class=" bg-white py-5">
    <div class="container">
        <div class="row bg-light box-shadow border-radius">
            <div class="col-12 text-center py-5">
                <?php 

                $faculdades = new Faculdade();
                $user = new User();


    echo ' <h1 class="display-4 text-primary mb-3">Lista de Faculdades</h1>

    <table border="0" class="table table-lg table-dark">
                <thead class="bg-primary">
                    <tr>
                        <th scope="col">Numero</th>
                        <th scope="col">Nome</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Contacto</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Operações</th>
                    </tr>
            </thead>';

                foreach($faculdades->All()->results() as $faculdade){     
                    if($faculdade->id!='GERAL'){
                 echo '<tbody>
                        <tr>
                            <td>'.$faculdade->id.'</td>
                            <td>'.$faculdade->nome.'</td>
                            <td>'.$faculdade->email.'</td>
                            <td>'.$faculdade->contacto.'</td>
                            <td>'.$faculdade->descricao.'</td>';
                            echo'<td>
                                            <a href="../../controller/consultasAdmin.php?codf='.$faculdade->id.'" onclick="return confirm(\'Pretende eleminar este dado?\');">Eliminar</a> | 
                                                <a href="formCadastroActu?cod='.$faculdade->id.'">Actualizar</a>
                                    </td>
                        </tr>
                    </tbody>';
                //echo "{$usuario->id} - {$usuario->nome} - {$usuario->email} - {$usuario->id_faculdade} <br>";
                }
            }
                     echo'</table>';    
                
                ?>
            </div>
        </div>
    </div>
</section>

<?php 
    }
?>