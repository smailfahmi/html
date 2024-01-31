<?
require('./dao/InstitutoDao.php');
class InstitutosController extends Base
{

    public static function institutos()
    {
        $metodo = $_SERVER['REQUEST_METHOD'];
        $recursos = self::divideUri();
        $filtros = self::condiciones();
        switch ($metodo) {
            case 'GET':
                if (count($recursos) == 2 && count($filtros) == 0) {
                    $datos = InstitutoDao::findAll();
                } elseif (count($recursos) == 2 && count($filtros) > 0) {
                    $datos = self::buscarFiltros();
                } elseif (count($recursos) == 3) {
                    $datos = InstitutoDao::findById($recursos[2]);
                }

                $datos = json_encode($datos);
                self::response("HTTP/1.0 200", $datos);
                break;

            case 'POST':
                $datos = file_get_contents('php://input');
                $datos = json_decode($datos, true);
                if (isset($datos['nombre']) && isset($datos['localidad']) && isset($datos['telefono'])) {
                    $insti = new Instituto(null, $datos['nombre'], $datos['localidad'], $datos['telefono']);
                    if (InstitutoDao::insert($insti)) {
                        $insti = InstitutoDao::findLast();
                        $datos = json_encode($insti);
                        self::response("HTTP/1.0 201 insercion correcta", $datos);
                    }
                } else {

                    self::response("HTTP/1.0 400 insercion correcta", 'Los datos introducidos son incorrector.');
                }

                break;
            case 'PUT':
                if (count($recursos) == 3) {
                    $permitimos = ['nombre', 'localidad', 'telefono'];
                    $datos = file_get_contents('php://input');
                    $datos = json_decode($datos, true);
                    foreach ($datos as $key => $value) {
                        if (!in_array($key, $permitimos)) {
                            self::response("HTTP/1.0 404 No permite el Parametro " . $key);
                        }
                    }
                    $insti = InstitutoDao::findById($recursos[2]);
                    if (count($insti) == 1) {
                        $insti = (object) $insti[0];
                        if (InstitutoDao::update($recursos[2])) {

                        }
                    } else {
                        self::response("HTTP/1.0 400 insercion correcta", 'El id no pertenece a nadie.');
                    }
                    $insti = new Instituto(null, $datos['nombre'], $datos['localidad'], $datos['telefono']);
                    if (InstitutoDao::insert($insti)) {
                        $insti = InstitutoDao::findLast();
                        $datos = json_encode($insti);
                        self::response("HTTP/1.0 201 insercion correcta", $datos);
                    }

                } else
                    self::response("HTTP/1.0 400 insercion correcta", 'Los datos introducidos son incorrector.');
                break;

            case 'DELETE':
                # code...
                break;


            default:
                self::response("HTTP/1.0 404 Metodo incorrecta");
                break;


        }

    }
    public static function buscarFiltros()
    {
        $permitimos = ['nombre', 'localidad'];
        $filtros = self::condiciones();
        foreach ($filtros as $key => $value) {
            if (!in_array($key, $permitimos)) {
                self::response("HTTP/1.0 404 No permite el Parametro " . $key);
            }
        }
        return InstitutoDao::findByFultros($filtros);
    }

}