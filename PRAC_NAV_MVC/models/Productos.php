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
        $this->usuario = $usuario;
        $this->clave = $clave;
        $this->nombre = $nombre;
        $this->correo = $correo;
        $this->perfil = $perfil;
        $this->fecha_nacimiento = $fecha_nacimiento;
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