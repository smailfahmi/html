<?

function insertarcookier()
{
    if (count($_COOKIE) >= 3) {
        # code...
    }
    setcookie("id" . $_GET['id'], $_GET['id'], time() + 3600, '/');
    //manera de guardar normal
    // setcookie('id', $_GET['id']);
    // setcookie('id1', $_GET['id'], time() - (3600), '/'); //para borrarla
    // setcookie('id2', $_GET['id'], time() + (3600)); //guarda durante una hora
}
function insertarcookier1()
{
    // Obtener los IDs anteriores de la cookie si existen
    $idsAnteriores = obtenerIdsDesdeCookies();

    // Agregar el nuevo ID a la lista de IDs anteriores
    $id = $_GET['id'];
    $idsAnteriores[] = $id;

    // Guardar la lista actualizada de IDs en la cookie
    guardarIdsEnCookies($idsAnteriores);
}

function guardarIdsEnCookies($ids)
{
    // Convertir el array de IDs a formato serializado
    $idsSerializados = serialize($ids);

    // Establecer la cookie con los IDs serializados
    setcookie("ids", $idsSerializados, time() + 3600, '/'); // Puedes ajustar el tiempo de expiración y el path según tus necesidades
}
function obtenerIdsDesdeCookies()
{
    if (isset($_COOKIE['ids'])) {
        // Obtener el valor de la cookie y deserializarlo a un array
        $idsSerializados = $_COOKIE['ids'];
        $ids = unserialize($idsSerializados);

        // Devolver el array de IDs
        return $ids;
    } else {
        return array(); // Devolver un array vacío si no hay IDs en la cookie
    }
}