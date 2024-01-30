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
                } elseif (count($recursos) == 3 && count($filtros) > 0) {
                    self::buscarFiltros();
                    $datos = InstitutoDao::findById($recursos[2]);
                } elseif (count($recursos) == 3) {
                    $datos = InstitutoDao::findById($recursos[2]);
                }

                $datos = json_encode($datos);
                self::response("HTTP/1.0 200", $datos);
                break;

            case 'POST':
                # code...
                break;

            case 'PUT':
                # code...
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
        return true;
    }

}