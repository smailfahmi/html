<?
class User
{
    private $id;
    private $nombre;
    private $contra;
    private $perfil;
    private $activo;

    function __construct($id, $nombre, $contra, $perfil, $activo)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->contra = $contra;
        $this->perfil = $perfil;
        $this->activo = $activo;
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
