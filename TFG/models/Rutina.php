<?
class Rutina
{
    private $idRutina;
    private $tipoRutina;
    private $fechaInicio;
    private $idUsuarioFK;
    private $fechaFin;

    public function __construct($idRutina, $tipoRutina, $fechaInicio, $idUsuarioFK, $fechaFin)
    {
        $this->idRutina = $idRutina;
        $this->tipoRutina = $tipoRutina;
        $this->fechaInicio = $fechaInicio;
        $this->idUsuarioFK = $idUsuarioFK;
        $this->fechaFin = $fechaFin;
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