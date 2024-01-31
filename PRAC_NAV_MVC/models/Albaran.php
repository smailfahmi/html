<?
class Albaran
{
    private $id;
    private $producto_id;
    private $administrador_id;
    private $cantidad_anadida;
    private $fecha_albaran;

    public function __construct($id, $producto_id, $administrador_id, $cantidad_anadida, $fecha_albaran)
    {
        $this->id = $id;
        $this->producto_id = $producto_id;
        $this->administrador_id = $administrador_id;
        $this->cantidad_anadida = $cantidad_anadida;
        $this->fecha_albaran = $fecha_albaran;
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