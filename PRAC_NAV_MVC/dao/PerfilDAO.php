<?
class PerfilDAO
{

    public static function findAll()
    {
        $sql = "SELECT * FROM Perfil";
        $parametros = array();
        $result = FactoryBd::realizarConsulta($sql, $parametros);
        $array_perfil = array();
        while ($Perfiles = $result->fetchObject()) {
            $perfil = new Perfil(
                $Perfiles->codigo,
                $Perfiles->nombre
            );
            array_push($array_perfil, $perfil);

        }

        return $array_perfil;
    }

    public static function insert($perfil)
    {
        $sql = "INSERT INTO Perfil (codigo,nombre)VALUES (?, ?)";
        $parametros = array(
            $perfil->codigo,
            $perfil->nombre
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