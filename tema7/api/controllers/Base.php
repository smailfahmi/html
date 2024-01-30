<?

class Base
{
    public static function response($head, $body = '')
    {
        header($head, $body);
        echo $body;
    }

    public static function divideUri()
    {
        $uri = $_SERVER['PATH_INFO'];
        return explode('/', $uri);
    }
    public static function condiciones()
    {
        $filtros = $_SERVER['QUERY_STRINGS'];
        parse_str($_SERVER['QUERY_STRINGS'], $filtros);
        return $filtros;
    }



}

?>