<?
class DatosUsuarioDAO
{

    public static function findAll()
    {
        try {
            $sql = "SELECT * FROM datosUsuario";
            $parametros = array();
            $result = FactoryBd::realizarConsulta($sql, $parametros);

            $array_datos = array();

            while ($datosStd = $result->fetchObject()) {
                $datos = new DatosUsuario(
                    $datosStd->id,
                    $datosStd->peso,
                    $datosStd->circunferenciaCuello,
                    $datosStd->circunferenciaAbdominal,
                    $datosStd->niveActividadDiaria,
                    $datosStd->fechaRegistro,
                    $datosStd->objetivo,
                    $datosStd->idUsuarioFK
                );

                array_push($array_datos, $datos);
            }

            // Liberar los recursos
            $result = null;

            return $array_datos;
        } catch (PDOException $e) {
            // Handle the exception (e.g., log it, display an error message)
            error_log("Error al buscar usuarios: " . $e->getMessage());
            return array();
        }
    }


    public static function findById($id)
    {
        $sql = "SELECT * FROM datosUsuario WHERE id = ?";
        $parametros = array($id);
        $result = FactoryBd::realizarConsulta($sql, $parametros);

        if ($result && $result->rowCount() > 0) {
            $datosStd = $result->fetchObject();
            $datos = new DatosUsuario(
                $datosStd->id,
                $datosStd->peso,
                $datosStd->circunferenciaCuello,
                $datosStd->circunferenciaAbdominal,
                $datosStd->niveActividadDiaria,
                $datosStd->fechaRegistro,
                $datosStd->objetivo,
                $datosStd->idUsuarioFK
            );
            return $datos;
        } else {
            return null;
        }
    }

    public static function insert($datosUsuario)
    {
        try {
            $sql = "INSERT INTO datosUsuario (id, peso, circunferenciaCuello, circunferenciaAbdominal, niveActividadDiaria, fechaRegistro, objetivo, idUsuarioFK) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

            $parametros = array(
                $datosUsuario->id,
                $datosUsuario->peso,
                $datosUsuario->circunferenciaCuello,
                $datosUsuario->circunferenciaAbdominal,
                $datosUsuario->niveActividadDiaria,
                $datosUsuario->fechaRegistro,
                $datosUsuario->objetivo,
                $datosUsuario->idUsuarioFK
            );

            $result = FactoryBd::realizarConsulta($sql, $parametros);

            return $result !== false;
        } catch (PDOException $e) {
            error_log("Error al insertar datosUsuario: " . $e->getMessage());
            return false;
        }
    }

    public static function update($datosUsuario)
    {
        try {
            $sql = "UPDATE datosUsuario SET peso = ?, circunferenciaCuello = ?, circunferenciaAbdominal = ?, niveActividadDiaria = ?, fechaRegistro = ?, objetivo = ?, idUsuarioFK = ? WHERE id = ?";

            $parametros = array(
                $datosUsuario->peso,
                $datosUsuario->circunferenciaCuello,
                $datosUsuario->circunferenciaAbdominal,
                $datosUsuario->niveActividadDiaria,
                $datosUsuario->fechaRegistro,
                $datosUsuario->objetivo,
                $datosUsuario->idUsuarioFK,
                $datosUsuario->id,
            );

            $result = FactoryBd::realizarConsulta($sql, $parametros);

            return $result !== false;
        } catch (PDOException $e) {
            error_log("Error al actualizar datosUsuario: " . $e->getMessage());
            return false;
        }
    }
}
