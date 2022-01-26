<section class=" bg-white py-5">
    <div class="container">
        <div class="row bg-light box-shadow border-radius">
            <div class="col-12 text-center py-5">


                <h1 class="display-4 text-primary mb-3">Dados do Usúario</h1>
      

                <form method="POST" action="" class="form mx-auto">
                    

                    <label class="label-input" for="">
                    <i class="far fa-user icon-modify"></i>
                    <input type="password" name="password" placeholder="Senha actual" value="<?php echo Session::get('senha'); ?>" > 
                    </label>

                    <label class="label-input" for="">
                    <i class="far fa-user icon-modify"></i>
                    <input type="password" name="new_password" placeholder="Nova Senha"> 
                    </label>

                    <label class="label-input" for="">
                    <i class="far fa-user icon-modify"></i>
                    <input type="password" name="password_again" placeholder="Confirme a senha"> 
                    </label>
                    
                    
                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                    <input class="btn btn-primary btn-lg" type="submit" value="Actualizar" name="novoAdmin">
                </form>

                </div>
        </div>
    </div>
</section>