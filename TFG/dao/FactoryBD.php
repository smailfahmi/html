<?
class FactoryBd
{
    private static $conn;

    public static function realizarConsulta($sql, $array_parametros)
    {
        try {
            self::$conn = new PDO('mysql:host=' . IP . ';dbname=' . BD, USER, PASS);
            $stmt = self::$conn->prepare($sql);
            $stmt->execute($array_parametros);

        } catch (PDOException $e) {
            echo $e->getMessage();
            unset(self::$conn);
        }
        return $stmt;
    }
   
}
?>
