<?
class Productos
{
    private $id;
    private $nombre;
    private $precio;
    private $descripcion;
    private $imagen_url;
    private $stock;
    private $categoria_id;
    private $visible;

    public function __construct($id, $nombre, $precio, $descripcion, $imagen_url, $stock, $categoria_id, $visible)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->descripcion = $descripcion;
        $this->imagen_url = $imagen_url;
        $this->stock = $stock;
        $this->categoria_id = $categoria_id;
        $this->visible = $visible;
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