<?
class Pedido
{
    private $id;
    private $idRutinaFK;
    private $idEjercicioFK;
    private $repeticiones;
    private $repeticionesLogradas;
    private $diaDeSemana;

    public function __construct($id, $idRutinaFK, $idEjercicioFK, $repeticiones, $repeticionesLogradas, $diaDeSemana)
    {
        $this->id = $id;
        $this->idRutinaFK = $idRutinaFK;
        $this->idEjercicioFK = $idEjercicioFK;
        $this->repeticiones = $repeticiones;
        $this->repeticionesLogradas = $repeticionesLogradas;
        $this->diaDeSemana = $diaDeSemana;
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