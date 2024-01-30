<?
class Usuario
{
    private $id;
    private $usuario;
    private $clave;
    private $nombre;
    private $correo;
    private $perfil;
    private $fecha_nacimiento;

    public function __construct($id, $usuario, $clave, $nombre, $correo, $perfil, $fecha_nacimiento)
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