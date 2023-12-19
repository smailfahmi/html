<?
define('IP', '192.168.7.205');
define('USER', 'sesiones');
define('PASS', 'seguro');
function validaUsuari($user, $pass)
{
    try {
        $DSN = 'mysql:host=' . IP . ';dbname=sesiones';
        $con = new PDO($DSN, USER, PASS);
        // $con = mysqli_connect(IP, USER, PASS, 'sesiones');
        $sql = 'select * from usuarios where usuario= ? and clave=?';
        $stmt = $con->prepare($sql);
        $result = $stmt->execute(array($user, sha1($pass)));
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