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

                 $usuarios = new User();

 echo ' <h1 class="display-4 text-primary mb-3">Lista de Usuarios</h1>

<table border="0" class="table table-lg table-dark">
            <thead class="bg-primary">
                <tr>
                    <th scope="col">Numero</th>
                    <th scope="col">Nome do Usuario</th>
                    <th scope="col">Nome do Proprio</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Faculdade</th>
                    <th scope="col">Opções</th>
                </tr>
        </thead>';


              
                    foreach($usuarios->All()->results() as $usuario) {
                       echo '<tbody>
                            <tr>
                                <td>'.$usuario->id.'</td>
                                <td>'.$usuario->username.'</td>
                                <td>'.$usuario->name.'</td>
                                <td>'.$usuario->email.'</td>     
                                <td>'.$usuario->id_faculdade.'</td>';
                                if($usuarios->data()->id == $usuario->id){
                                echo'<td>
                                                
                                                    <a href="perfil?codAt='.$usuario->id.'">Actualizar</a>
                                        </td>';

                                    }

                            echo'</tr>
                        </tbody>';
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
