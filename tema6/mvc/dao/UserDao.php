<?
class UserDao
{

    public static function findAll()
    {
        $sql = "select * from Usuario";
        $parametros = array();
        $result = FactoryBd::realizarConsulta($sql, $parametros);
        $array_usuarios = array();
        while ($usuarioStd = $result->fetchObject()) {
            $usuario = new User(
                $usuarioStd->codUsuario,
                $usuarioStd->password,
                $usuarioStd->descUsuario,
                $usuarioStd->perfil,
                $usuarioStd->fechaUltimaConexion

            );
            array_push($array_usuarios, $usuario);

        }

        return $array_usuarios;
    }
    public static function findById($id)
    {
        $sql = "select * from Usuario where codUsuario = ?";
        $parametros = array($id);
        $result = FactoryBd::realizarConsulta($sql, $parametros);
        if ($result->rowCount() == 1) {
            $usuarioStd = $result->fetchObject();
            $usuario = new User(
                $usuarioStd->codUsuario,
                $usuarioStd->password,
                $usuarioStd->descUsuario,
                $usuarioStd->perfil,
                $usuarioStd->fechaUltimaConexion

            );
            return $usuario;
        } else
            return null;


    }
    public static function insert($usuario)
    {
        $sql = "INSERT INTO Usuario (codUsuario, password,descUsuario, fechaUltimaConexion)VALUES (?, ?, ?,?)";
        //inserta todos los atributos
        $parametros = (array) $usuario;
        unset($parametros['User perfil']);
        $result = FactoryBd::realizarConsulta($sql, $parametros);
        return true;
    }
}