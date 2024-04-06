<?
class Ejercicios
{
    private $idEjercicio;
    private $nombreEjercicio;
    private $descripcionEjercicio;
    private $grupoMuscular;
    private $dificultad;
    private $enlace;

    public function __construct($idEjercicio, $nombreEjercicio, $descripcionEjercicio, $grupoMuscular, $dificultad, $enlace)
    {
        $this->idEjercicio = $idEjercicio;
        $this->nombreEjercicio = $nombreEjercicio;
        $this->descripcionEjercicio = $descripcionEjercicio;
        $this->grupoMuscular = $grupoMuscular;
        $this->dificultad = $dificultad;
        $this->enlace = $enlace;
    }


    public function __get($att)
    {
        if (property_exists(__CLASS__, $att)) {
            return $this->$att;
        }
    }
    public function __set($att, $val)
    {
        if (property_exists(__CLASS__, $att)) {
            $this->$att = $val;
        }
    }
}
