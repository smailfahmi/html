<?
class Perfil
{
    private $codigo;
    private $nombre;

    public function __construct($codigo, $nombre)
    {
        $this->codigo = $codigo;
        $this->nombre = $nombre;

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