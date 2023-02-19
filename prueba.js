document.getElementById('botonCarga').addEventListener('click', cargarJSON);

function cargarJSON() {
    fetch('./prueba.json')
        //carga una respuesta  
        .then(function(res){
            return res.json();
        })
        .then(function(data){
            console.log(data)
        })
}