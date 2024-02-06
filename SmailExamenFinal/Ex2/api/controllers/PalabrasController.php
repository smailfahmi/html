<?
require('./dao/PalabrasDao.php');
class PalabrasController extends Base
{

    public static function palabras()
    {
        $metodo = $_SERVER['REQUEST_METHOD'];
        $recursos = self::divideUri();
        $filtros = self::condiciones();
        switch ($metodo) {
            case 'GET':
                if (count($recursos) == 2 && count($filtros) == 0) {
                    $datos = PalabrasDao::findAll();
                } elseif (count($recursos) == 2 && count($filtros) > 0) {
                    $datos = self::buscarFiltros();
                } elseif (count($recursos) == 3) {
                    $datos = InstitutoDao::findById($recursos[2]);
                }


                $palabra = $datos[rand(0, count($datos) - 1)]['palabra'];
                $datos = json_encode($datos);

                self::response("HTTP/1.0 200", $palabra);
                break;

            default:
                self::response("HTTP/1.0 404 Metodo incorrecta");
                break;


        }

    }
    public static function buscarFiltros()
    {
        $permitimos = ['letras'];
        $filtros = self::condiciones();
        foreach ($filtros as $key => $value) {
            if (!in_array($key, $permitimos)) {
                self::response("HTTP/1.0 400", ' No permite el Parametro ' . $key);
            }
        }
        if ((int) $filtros['letras'] < 3) {
            self::response("HTTP/1.0 400 longitud muy corta", );
        } else
            return PalabrasDao::findById((int) $filtros['letras']);
    }

}