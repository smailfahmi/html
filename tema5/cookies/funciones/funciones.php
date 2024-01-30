<?
require('confiBd.php');
function findAll()
{
    try {
        $DSN = 'mysql:host=' . IP . ';dbname=' . BD;
        $con = new PDO($DSN, USER, PASS);
        $sql = 'select * from producto';
        $stmt = $con->prepare($sql);
        $result = $stmt->execute();
        $array_productos = array();
        while ($productos = $stmt->fetch(PDO::FETCH_ASSOC)) {
            array_push($array_productos, $productos);
        }

        return $array_productos;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {

        unset($con);
    }

}
function findId($id)
{
    try {
        $DSN = 'mysql:host=' . IP . ';dbname=' . BD;
        $con = new PDO($DSN, USER, PASS);
        // $con = mysqli_connect(IP, USER, PASS, 'sesiones');
        $sql = 'select * from producto where codigo = ?';
        $stmt = $con->prepare($sql);
        $result = $stmt->execute(array($id));
        $producto = $stmt->fetch(PDO::FETCH_ASSOC);
        return $producto;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {

        unset($con);
    }
}