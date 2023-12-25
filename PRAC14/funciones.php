<?
function enviado()
{
    if (!isset($_REQUEST['Enviar'])) {
        return false;
    }
    return true;
}
function textovacio($name)
{
    if (empty($_REQUEST[$name])) {
        return true;
    }
    return false;
}
function permisos($url)
{
    if (!in_array($url, $_SESSION['usuario']['paginas'])) {
        header('Location: ../login.php');
        return $_SESSION['error'] = 'no tiene permiso ';
        exit;
    }


}