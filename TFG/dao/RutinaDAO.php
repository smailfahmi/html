<?
class RutinaDAO
{
    public static function findAll()
    {
        try {
            $sql = "SELECT * FROM rutina";
            $parametros = array();
            $result = FactoryBd::realizarConsulta($sql, $parametros);

            $array_datos = array();

            while ($datosStd = $result->fetchObject()) {
                $datos = new Rutina(
                    $datosStd->id,
                    $datosStd->tipoRutina,
                    $datosStd->fechaInicio,
                    $datosStd->idUsuarioFK,
                    $datosStd->fechaFin
                );

                array_push($array_datos, $datos);
            }

            // Liberar los recursos
            $result->closeCursor();
            $result = null;

            return $array_datos;
        } catch (PDOException $e) {
            // Handle the exception (e.g., log it, display an error message)
            error_log("Error al buscar rutinas: " . $e->getMessage());
            return array();
        }
    }


    public static function findById($id)
    {
        try {
            $sql = "SELECT * FROM rutina WHERE id = ?";
            $parametros = array($id);
            $result = FactoryBd::realizarConsulta($sql, $parametros);

            if ($result && $result->rowCount() > 0) {
                $datosStd = $result->fetchObject();
                $rutina = new Rutina(
                    $datosStd->id,
                    $datosStd->tipoRutina,
                    $datosStd->fechaInicio,
                    $datosStd->idUsuarioFK,
                    $datosStd->fechaFin
                );

                // Liberar los recursos
                $result->closeCursor();
                $result = null;

                return $rutina;
            } else {
                // Liberar los recursos
                $result->closeCursor();
                $result = null;

                return null;
            }
        } catch (PDOException $e) {
            // Handle the exception (e.g., log it, display an error message)
            error_log("Error al buscar rutina por ID: " . $e->getMessage());
            return null;
        }
    }


    public static function insert($datosUsuario)
    {
        try {
            $sql = "INSERT INTO rutina (id, tipoRutina, fechaInicio, idUsuarioFK, fechaFin) VALUES (?, ?, ?, ?, ?)";

            $parametros = array(
                $datosUsuario->id,
                $datosUsuario->tipoRutina,
                $datosUsuario->fechaInicio,
                $datosUsuario->idUsuarioFK,
                $datosUsuario->fechaFin
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
            $sql = "UPDATE rutina SET tipoRutina = ?, fechaInicio = ?, idUsuarioFK = ?, fechaFin = ? WHERE id = ?";

            $parametros = array(
                $datosUsuario->tipoRutina,
                $datosUsuario->fechaInicio,
                $datosUsuario->idUsuarioFK,
                $datosUsuario->fechaFin,
                $datosUsuario->id
            );

            $result = FactoryBd::realizarConsulta($sql, $parametros);

            return $result !== false;
        } catch (PDOException $e) {
            error_log("Error al actualizar datosUsuario: " . $e->getMessage());
            return false;
        }
    }
}
