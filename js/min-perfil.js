
var perfil = document.querySelector(".mini-perfil");
var user = document.querySelector(".conta");

    function remover(event){
       // console.log("chegei");
        //perfil.classList.toggle('estado');
        perfil.classList.toggle('estado');
    }

    
   /* function adicionar(event){
        console.log("chegei");
        //perfil.classList.toggle('estado');
        perfil.classList.add('estado');
    }*/
user.addEventListener('mouseenter', remover);
//user.addEventListener('mouseout', adicionar);