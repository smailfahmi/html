<?
class Usuario
{
    private $id;
    private $usuario;
    private $password;
    private $nombre;
    private $apellidos;
    private $telefono;
    private $altura;
    private $sexo;
    private $fechaNacimiento;
    private $tipoUsuario;

    public function __construct($id, $usuario, $password, $nombre, $apellidos, $telefono, $altura, $sexo, $fechaNacimiento, $tipoUsuario)
    {
        $this->id = $id;
        $this->usuario = $usuario;
        $this->password = $password;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->telefono = $telefono;
        $this->altura = $altura;
        $this->sexo = $sexo;
        $this->fechaNacimiento = $fechaNacimiento;
        $this->tipoUsuario = $tipoUsuario;
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
