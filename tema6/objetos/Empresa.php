<?
class Empresa
{
    public static $cont;
    static function saluda()
    {

        return self::saluda1();

    }
    static function saluda1()
    {

        return "hola soy empresa";
    }
    private $cif;
    public $nombre;
    private $localidad;

    function __construct($cif, $nombre, $localidad)
    {
        self::$cont++;
        $this->nombre = $nombre;
        $this->cif = $cif;
        $this->localidad = $localidad;

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

    public function __toString()
    {

        return $this->cif . ":" . $this->nombre . ":" . $this->localidad;
    }

    // public function getCif()
    // {
    //     return $this->cif;
    // }

    // public function setCif($cif)
    // {
    //     $this->cif = $cif;
    // }

    // public function getNombre()
    // {
    //     return $this->nombre;
    // }

    // public function setNombre($nombre)
    // {
    //     $this->nombre = $nombre;
    // }

    // public function getLocalidad()
    // {
    //     return $this->localidad;
    // }

    // public function setLocalidad($localidad)
    // {
    //     $this->localidad = $localidad;
    // }

}