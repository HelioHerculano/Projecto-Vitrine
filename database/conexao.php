<?php

//conexao
$con = new mysqli('localhost','root','','vitrinebd');

//tratando os erros

if( $con->connect_error ){
    exit( "Erro: {$con->connect_error}" );
}