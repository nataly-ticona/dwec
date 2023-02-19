document.getElementById('botonCarga').addEventListener('click', cargarJSON);

function cargarJSON() {
    fetch('./prueba.json')
        //carga una respuesta  
        .then(function(res){
            return res.json();
        })
        // obtenemos los datos
        .then(function(data){
            let html = '';
            data.forEach(function (persona) {
                html+=`
                <p>${persona.nombre} ${persona.apellido} ${persona.dni}</p>
                `;
            });
            // imprimir los datos
            document.getElementById('resultado').innerHTML=html;
        })

}