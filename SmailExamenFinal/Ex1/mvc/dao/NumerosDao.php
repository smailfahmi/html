<?
class NumerosDao
{

    public static function ultimaApuesta($id)
    {
        $sql = 'SELECT * FROM numeros WHERE usuario_id = ? ORDER BY id DESC LIMIT 1';
        $parametros = array($id);
        $result = FactoryBd::realizarConsulta($sql, $parametros);
        if ($result->rowCount() == 1) {
            $ultimaApuesta = $result->fetchObject();
            $apuesta = new Numeros(
                $ultimaApuesta->id,
                $ultimaApuesta->usuario_id,
                $ultimaApuesta->numeros_elegidos,
                $ultimaApuesta->fecha,

            );
            return $apuesta;
        } else
            return null;
    }
    public static function insert($numeros)
    {
        $sql = "INSERT INTO numeros (id, usuario_id,numeros_elegidos, fecha)VALUES (?, ?, ?, ?)";
        $parametros = array(
            $numeros->id,
            $numeros->usuario_id,
            $numeros->numeros_elegidos,
            $numeros->fecha,
        );
        $result = FactoryBd::realizarConsulta($sql, $parametros);
        return true;
    }
    public static function update($numeros)
    {
        $sql = "UPDATE Usuario SET  usuario_id=?, numeros_elegidos=? ,fecha=? WHERE id=?";
        $parametros = array(
            $numeros->id,
            $numeros->usuario_id,
            $numeros->numeros_elegidos,
            $numeros->fecha,
        );

        $result = FactoryBd::realizarConsulta($sql, $parametros);
        return true;
    }
}
