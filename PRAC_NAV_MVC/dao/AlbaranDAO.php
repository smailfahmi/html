<?
class AlbaranDAO
{

    public static function findAll()
    {
        $sql = "SELECT * FROM Albaran";
        $parametros = array();
        $result = FactoryBd::realizarConsulta($sql, $parametros);
        $array_albaranes = array();
        while ($Albaranes = $result->fetchObject()) {
            $albaran = new Albaran(
                $Albaranes->id,
                $Albaranes->producto_id,
                $Albaranes->administrador_id,
                $Albaranes->cantidad_anadida,
                $Albaranes->fecha_albaran

            );
            array_push($array_albaranes, $albaran);

        }

        return $array_albaranes;
    }
    public static function findById($id)
    {
        $sql = "SELECT * FROM Albaran WHERE id = ?";
        $parametros = array($id);
        $result = FactoryBd::realizarConsulta($sql, $parametros);
        if ($result->rowCount() == 1) {
            $Albaranes = $result->fetchObject();
            $albaran = new Albaran(
                $Albaranes->id,
                $Albaranes->producto_id,
                $Albaranes->administrador_id,
                $Albaranes->cantidad_anadida,
                $Albaranes->fecha_albaran

            );
            return $albaran;
        } else
            return null;


    }
    public static function insert($albaran)
    {
        $sql = "INSERT INTO Albaran (id, producto_id,administrador_id, cantidad_anadida,fecha_albaran)VALUES (?, ?, ?, ?, ?)";
        $parametros = array(
            $albaran->id,
            $albaran->producto_id,
            $albaran->administrador_id,
            $albaran->cantidad_anadida,
            $albaran->fecha_albaran
        );
        $result = FactoryBd::realizarConsulta($sql, $parametros);
        if ($result) {
            // La inserción fue exitosa
            return true;
        } else {
            // La inserción falló
            return false;
        }
    }
    public static function update($albaran)
    {
        $sql = "UPDATE  Albaran SET producto_id=?,administrador_id=?, cantidad_anadida=?,fecha_albaran=? WHERE id =?";

        $parametros = array(
            $albaran->producto_id,
            $albaran->administrador_id,
            $albaran->cantidad_anadida,
            $albaran->fecha_albaran,
            $albaran->id

        );

        $result = FactoryBd::realizarConsulta($sql, $parametros);
        if ($result) {
            // La inserción fue exitosa
            return true;
        } else {
            // La inserción falló
            return false;
        }

    }

}