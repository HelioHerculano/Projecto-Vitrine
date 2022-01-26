

<section class=" bg-white py-5">
    <div class="container">
        <div class="row bg-light box-shadow border-radius">
            <div class="col-12 text-center py-5">

<h1 class="display-4 text-primary mb-3">Manter - se conectado</h1>
<form method="POST" action="subscribeheader.php" class="form mx-auto" enctype="multipart/form-data">


                    <input type="hidden" name="_captcha" value="false">

                    <input type="hidden" name="_autoresponse" value="Conectou-se com sucesso, vamos notificar-lhe sobre as novidades">

                    <input type="hidden" name="_cc" value="lucaspedroverissimo2004@gmail.com">

                    <label class="label-input" for="">
                        <i class="far fa-user icon-modify"></i>
                        <input type="text" name="name" placeholder="Informe o seu nome"> 
                    </label>

                    <label class="label-input" for="">
                    <i class="far fa-user icon-modify"></i>
                    <input type="email" name="email" placeholder="E-mail"> 
                    </label>

                    <!--<label class="text-left ml-5 px-5"> Faculdade</label>-->
                    <input type="hidden" name="remember" value="on">
                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                    <input class="btn btn-primary btn-lg" type="submit"  value="Conectar-se">
                </form>

            </div>
        </div>
    </div>
</section>
