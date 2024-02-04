<?
class Numeros
{
    private $id;
    private $usuario_id;
    private $numeros_elegidos;
    private $fecha;

    function __construct($id,$usuario_id, $numeros_elegidos, $fecha)
    {
        $this->id = $id;
        $this->usuario_id = $usuario_id;
        $this->numeros_elegidos = $numeros_elegidos;
        $this->fecha = $fecha;
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
