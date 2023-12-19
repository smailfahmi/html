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