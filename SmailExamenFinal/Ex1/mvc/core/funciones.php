<?
function validarFormulario(&$errores)
{

    # code...
    if (isset($_REQUEST['usuarioLog'])) {
        comNombre($errores);
    }
    if (isset($_REQUEST['contraLog'])) {
        comcontra($errores);
    }
    if (count($errores) == 0) {
        return true;
    } else
        return false;
}
function comNombre(&$errores)
{
    if (textoVacio('usuarioLog')) {
        $errores['usuarioLog'] = "este campo esta vacio";
    }
}

function comcontra(&$errores)
{
    if (textoVacio('contraLog')) {
        $errores['contraLog'] = "este campo esta vacio";
    }
}
function textovacio($name)
{
    if (empty($_REQUEST[$name])) {
        return true;
    }
    return false;
}
function escribirErrores($errores, $name)
{

    if (isset($errores[$name])) {
        echo '<span style="color: red;">' . $errores[$name] . '</span>';
    }
}
function escribirNombre($name)
{
    if (registrarse() && !empty($_REQUEST[$name])) {
        echo $_REQUEST[$name];
    }
}
function validarchek()
{
    if (isset($_REQUEST['recuerdame'])) {
        return true;
    } else
        return false;
}
function validado()
{
    if (isset($_SESSION['usuario']))
        return true;
    else
        return false;
}
function get($recurso)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, URI_API . $recurso);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}
function validar2(&$errores)
{

    if (is_numeric($_REQUEST['letras'])) {
        return true;
    } else {
        $errores['numerico'] = "este campo no es numerico";
        return false;
    }

}