<?
class DatosUsuario
{
    private $id;
    private $peso;
    private $circunferenciaCuello;
    private $circunferenciaAbdominal;
    private $niveActividadDiaria;
    private $fechaRegistro;
    private $objetivo;
    private $idUsuarioFK;

    public function __construct($id, $peso, $circunferenciaCuello, $circunferenciaAbdominal, $niveActividadDiaria, $fechaRegistro, $objetivo, $idUsuarioFK)
    {
        $this->id = $id;
        $this->peso = $peso;
        $this->circunferenciaCuello = $circunferenciaCuello;
        $this->circunferenciaAbdominal = $circunferenciaAbdominal;
        $this->niveActividadDiaria = $niveActividadDiaria;
        $this->fechaRegistro = $fechaRegistro;
        $this->objetivo = $objetivo;
        $this->idUsuarioFK = $idUsuarioFK;
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