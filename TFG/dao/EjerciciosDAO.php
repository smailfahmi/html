<?
class EjerciciosDAO
{

    public static function findAll()
    {
        try {
            $sql = "SELECT * FROM ejercicios";
            $parametros = array();
            $result = FactoryBd::realizarConsulta($sql, $parametros);

            $array_datos = array();

            while ($datosStd = $result->fetchObject()) {
                $datos = new Ejercicios(
                    $datosStd->id,
                    $datosStd->nombreEjercicio,
                    $datosStd->descripcionEjercicio,
                    $datosStd->grupoMuscular,
                    $datosStd->dificultad,
                    $datosStd->enlace
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
        $sql = "SELECT * FROM ejercicios WHERE id = ?";
        $parametros = array($id);
        $result = FactoryBd::realizarConsulta($sql, $parametros);

        if ($result && $result->rowCount() > 0) {
            $datosStd = $result->fetchObject();
            $datos = new Ejercicios(
                $datosStd->id,
                $datosStd->nombreEjercicio,
                $datosStd->descripcionEjercicio,
                $datosStd->grupoMuscular,
                $datosStd->dificultad,
                $datosStd->enlace
            );
            return $datos;
        } else {
            return null;
        }
    }
    public static function findByNombre($nombre)
    {
        $sql = "SELECT * FROM ejercicios WHERE nombreEjercicio LIKE ?";
        $parametros = array("%$nombre%");
        $result = FactoryBd::realizarConsulta($sql, $parametros);

        $datosArray = array();
        while ($row = $result->fetchObject()) {
            $datos = new Ejercicios(
                $row->id,
                $row->nombreEjercicio,
                $row->descripcionEjercicio,
                $row->grupoMuscular,
                $row->dificultad,
                $row->enlace
            );
            $datosArray[] = $datos;
        }

        return $datosArray;
    }
    public static function findByGrupoMuscular($grupoMuscular)
    {
        $sql = "SELECT * FROM ejercicios WHERE grupoMuscular = ?";
        $parametros = array($grupoMuscular);
        $result = FactoryBd::realizarConsulta($sql, $parametros);

        $datosArray = array();
        while ($row = $result->fetchObject()) {
            $datos = new Ejercicios(
                $row->id,
                $row->nombreEjercicio,
                $row->descripcionEjercicio,
                $row->grupoMuscular,
                $row->dificultad,
                $row->enlace
            );
            $datosArray[] = $datos;
        }

        return $datosArray;
    }
  }
