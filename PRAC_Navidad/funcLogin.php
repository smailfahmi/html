<?
define('IP', '192.168.0.205');
define('USER', 'tienda');
define('PASS', 'SmailSmail');
function validaUsuari($user, $pass)
{
    try {
        $DSN = 'mysql:host=' . IP . ';dbname=tienda';
        $con = new PDO($DSN, USER, PASS);
        // $con = mysqli_connect(IP, USER, PASS, 'sesiones');
        $sql = 'select * from Usuarios where usuario= ? and clave=?';
        $stmt = $con->prepare($sql);
        $result = $stmt->execute(array($user,$pass));
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($usuario) {
            unset($con);
            return $usuario;
        }
        return false;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        return $usuario;
        unset($con);
    }

}
// function misPaginas()
// {
//     try {
//         $DSN = 'mysql:host=' . IP . ';dbname=sesiones';
//         $con = new PDO($DSN, USER, PASS);
//         $sql = 'select url from paginas where codigo in
//         (select codigoPagina from accede where codigoPerfil = ?)';
//         $stmt = $con->prepare($sql);
//         $stmt->execute([$_SESSION['usuario']['perfil']]);
//         $paginas = array();
//         while ($pagina = $stmt->fetch(PDO::FETCH_ASSOC)) {
//             array_push($paginas, $pagina['url']);
//         }
//         if (count($paginas) > 0) {

//             $_SESSION['usuario']['paginas'] = $paginas;
//             return $paginas;
//         } else {
//             return false;
//         }

//     } catch (PDOException $e) {
//         echo $e->getMessage();
//     } finally {
//         unset($con);
//     }
// }
function enviado()
{
    if (!isset($_REQUEST['Iniciar'])) {
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