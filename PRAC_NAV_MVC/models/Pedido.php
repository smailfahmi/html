<?
class Pedido
{
    private $id;
    private $producto_id;
    private $usuario_id;

    private $cantidad;
    private $fecha_pedido;
    public function __construct($id, $producto_id, $usuario_id, $cantidad, $fecha_pedido)
    {
        $this->id = $id;
        $this->producto_id = $producto_id;
        $this->usuario_id = $usuario_id;
        $this->cantidad = $cantidad;
        $this->fecha_pedido = $fecha_pedido;
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