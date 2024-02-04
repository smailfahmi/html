<?
class Sorteo
{
    private $fecha_actual;
    private $sorteo;


    function __construct($fecha_actual, $sorteo)
    {
        $this->fecha_actual = $fecha_actual;
        $this->sorteo = $sorteo;
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
