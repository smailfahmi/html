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
function validado()
{
    if (isset($_SESSION['usuario']))
        return true;
    else
        return false;
}
function admin()
{
    if ($_SESSION['usuario']->perfil === 'administrador') {
        return true;
    }
    return false;
}
function compruebaCheck(&$errores)
{

    if (textoVacio('opcionCh')) {
        $errores['opcionCh'] = "Marca una opcion";
    } elseif (count($_REQUEST['opcionCh']) != 5) {
        $errores['opcionCh'] = "Marca 5 opciones";
    } else
        return true;
}


function recuerdaChek($name, $valor)
{
    if (isset($_REQUEST[$name])) {
        foreach ($_REQUEST[$name] as $key => $value) {
            if ($valor == $value)
                return 'checked';
        }
        return '';
    } else if (isset($_REQUEST['borrar']))
        echo '';
}
