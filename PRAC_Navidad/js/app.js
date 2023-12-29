
const articulos = document.querySelectorAll('.articulo');
const home = document.querySelector('.home');
home.addEventListener('click', function () {
    window.location.href = 'index.html'; // Reemplaza 'index.html' con la ruta de tu página principal
});

const buscador = document.querySelector('.buscador');
// console.log(buscador);
const bBuscador = document.querySelector('.bBuscador');
// console.log(bBuscador);
bBuscador.addEventListener('click', buscar);
function buscar() {
    const textoBusqueda = buscador.value.toLowerCase();

    let seccion = null;

    switch (textoBusqueda) {
        case 'abrigo':
        case 'cazadora':
        case 'chaqueta':
        case 'plumas':
        case 'parka':
            seccion = document.getElementById('art1');
            break;
        case 'sudadera':
        case 'sudader con capucha':
        case 'sudadera capucha':
            seccion = document.getElementById('art4');
            break;
        case 'camiseta':
            seccion = document.getElementById('art7');
            break;
        case 'jeans':
        case 'vaqueros':
        case 'vaquero':
            seccion = document.getElementById('art10');
            break;
        case 'chandar':
        case 'ropa deportiva':
        case 'deporte':
            seccion = document.getElementById('art13');
            break;
        case 'calzones':
        case 'calzoncillos':
        case 'boxer':
            seccion = document.getElementById('art16');
            break;
        case 'calcetines':
        case 'pies':
            seccion = document.getElementById('art19');
            break;
        case 'zapatillas':
        case 'deportivas':
        case 'zapatilla':
            seccion = document.getElementById('art22');
            break;
        // Agrega otros casos según sea necesario

        default:
            break;
    }

    if (seccion) {
        seccion.scrollIntoView({ behavior: 'smooth' });
    }

}
function colocar(indice) {
    console.log(indice);
    let seccion;
    switch (indice) {
        case 0:
            seccion = document.getElementById('art1');
            break;
        case 1:
            seccion = document.getElementById('art4');
            break;
        case 2:
            seccion = document.getElementById('art7');
            break;
        case 3:
            seccion = document.getElementById('art10');
            break;
        case 4:
            seccion = document.getElementById('art13');
            break;
        case 5:
            seccion = document.getElementById('art16');
            break;
        case 6:
            seccion = document.getElementById('art19');
            break;
        case 7:
            seccion = document.getElementById('art22');
            break;
        // Agrega otros casos según sea necesario

        default:
            break;
    }
    if (seccion) {
        seccion.scrollIntoView({ behavior: 'smooth' });
    }

}
articulos.forEach((articulo, indice) => {
    articulo.addEventListener('click', colocar.bind(null, indice));
});

document.body.addEventListener("keypress", function (event) {
    console.log(event.key);
    if (event.key == "Enter") {
        buscar();
    }
});