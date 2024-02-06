<?
require('./models/Palabras.php');
require('./dao/FactoryBD.php');
class PalabrasDao
{

    public static function findAll()
    {
        $sql = "select * from palabras";
        $parametros = array();
        $result = FactoryBd::realizarConsulta($sql, $parametros);
        $palabrasStd = $result->fetchAll(PDO::FETCH_ASSOC);
        return $palabrasStd;
    }
    public static function findById($longitud)
    {
        $sql = "select * from palabras where num_letras = ?";
        $parametros = array($longitud);
        $result = FactoryBd::realizarConsulta($sql, $parametros);
        $palabrasStd = $result->fetchAll(PDO::FETCH_ASSOC);
        return $palabrasStd;

    }

}