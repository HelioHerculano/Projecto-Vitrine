<?php

spl_autoload_register(function($class){

    if(file_exists('../model/'.$class.'.php')) { 
        require('../model/'.$class.'.php');
    }

});