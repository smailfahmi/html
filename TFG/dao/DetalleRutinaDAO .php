<?
class DetalleRutinaDAO
{

    public static function findAll()
    {
        try {
            $sql = "SELECT * FROM detalleRutina";
            $parametros = array();
            $result = FactoryBd::realizarConsulta($sql, $parametros);

            $array_datos = array();

            while ($datosStd = $result->fetchObject()) {
                $datos = new DetalleRutina(
                    $datosStd->id,
                    $datosStd->idRutinaFK,
                    $datosStd->idEjercicioFK,
                    $datosStd->repeticiones,
                    $datosStd->repeticionesLogradas,
                    $datosStd->diaDeSemana
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
        $sql = "SELECT * FROM detalleRutina WHERE id = ?";
        $parametros = array($id);
        $result = FactoryBd::realizarConsulta($sql, $parametros);

        if ($result && $result->rowCount() > 0) {
            $datosStd = $result->fetchObject();
            $datos = new DetalleRutina(
                $datosStd->id,
                $datosStd->idRutinaFK,
                $datosStd->idEjercicioFK,
                $datosStd->repeticiones,
                $datosStd->repeticionesLogradas,
                $datosStd->diaDeSemana

            );
            return $datos;
        } else {
            return null;
        }
    }

    public static function insert($datosRutina)
    {
        try {
            $sql = "INSERT INTO detalleRutina (id, idRutinaFK, idEjercicioFK, repeticiones, repeticionesLogradas, diaDeSemana) VALUES (?, ?, ?, ?, ?, ?)";

            $parametros = array(
                $datosRutina->id,
                $datosRutina->idRutinaFK,
                $datosRutina->idEjercicioFK,
                $datosRutina->repeticiones,
                $datosRutina->repeticionesLogradas,
                $datosRutina->diaDeSemana
            );

            $result = FactoryBd::realizarConsulta($sql, $parametros);

            return $result !== false;
        } catch (PDOException $e) {
            error_log("Error al insertar datosUsuario: " . $e->getMessage());
            return false;
        }
    }

    public static function update($datosRutina)
    {
        try {
            $sql = "UPDATE detalleRutina SET idRutinaFK = ?, idEjercicioFK = ?, repeticiones = ?, repeticionesLogradas = ?, diaDeSemana = ? WHERE id = ?";

            $parametros = array(

                $datosRutina->idRutinaFK,
                $datosRutina->idEjercicioFK,
                $datosRutina->repeticiones,
                $datosRutina->repeticionesLogradas,
                $datosRutina->diaDeSemana,
                $datosRutina->id
            );

            $result = FactoryBd::realizarConsulta($sql, $parametros);

            return $result !== false;
        } catch (PDOException $e) {
            error_log("Error al actualizar datosUsuario: " . $e->getMessage());
            return false;
        }
    }
}
