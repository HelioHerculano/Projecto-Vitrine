var btnEntrar = document.querySelector("#entrar");
var btnRegistrar = document.querySelector("#registrar");
var body = document.querySelector("body");


btnEntrar.addEventListener("click", function() {
    body.className = "entrar-js";
});

btnRegistrar.addEventListener("click", function() {
    body.className = "registrar-js";
});


//const apresentacao = document.querySelector('ul.menu-desktop li:nth-child(4)');
