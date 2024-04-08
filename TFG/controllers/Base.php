<?
class Base
{
    public static function response($head, $body = '')
    {
        header('Content-Type: application/json');
        header($head);
        echo $body;
        exit;
    }
    

    public static function divideUri()
    {
        $uri = $_SERVER['PATH_INFO'];
        return explode('/', $uri);
    }
    public static function condiciones()
    {
        $filtros = $_SERVER['QUERY_STRING'];
        parse_str($_SERVER['QUERY_STRING'], $filtros);
        return $filtros;
    }
    public static function buscarFiltros($permitimos)
    {
        $filtros = self::condiciones();
        foreach ($filtros as $key => $value) {
            if (!in_array($key, $permitimos)) {
                return false;
                // self::response("HTTP/1.0 404 No permite el Parametro " . $key);
            } else
                return true;
        }
    }
    public static function retornaValores($variable)
    {
        $filtros = self::condiciones();
        foreach ($filtros as $key => $value) {
            if ($key == $variable) {
                return $value;
                // self::response("HTTP/1.0 404 No permite el Parametro " . $key);
            }
        }
        return null;
    }
}
