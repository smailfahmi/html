<?
class UsuarioDao
{

    public static function findAll()
    {
        $sql = "select * from usuarios";
        $parametros = array();
        $result = FactoryBd::realizarConsulta($sql, $parametros);
        $array_usuarios = array();
        while ($usuarioStd = $result->fetchObject()) {
            $usuario = new Usuarios(
                $usuarioStd->id_usuario,
                $usuarioStd->username,
                $usuarioStd->password,
                $usuarioStd->tipo
            );
            array_push($array_usuarios, $usuario);
        }

        return $array_usuarios;
    }
    public static function findById($id)
    {
        $sql = "select * from usuarios where id_usuario = ?";
        $parametros = array($id);
        $result = FactoryBd::realizarConsulta($sql, $parametros);
        if ($result->rowCount() == 1) {
            $usuarioStd = $result->fetchObject();
            $usuario = new Usuarios(
                $usuarioStd->id_usuario,
                $usuarioStd->username,
                $usuarioStd->password,
                $usuarioStd->tipo
            );
            return $usuario;
        } else
            return null;
    }


    public static function validarUsuario($nombre, $contra)
    {
        //return 1 objeto usuario
        $sql = "select * from usuarios where username = ? and password= ? ";
        $parametros = array($nombre, sha1($contra));
        $result = FactoryBD::realizarConsulta($sql, $parametros);

        if ($result->rowCount() == 1) {
            $usuarioStd = $result->fetchObject();
            $usuario = new Usuarios(
                $usuarioStd->id_usuario,
                $usuarioStd->username,
                $usuarioStd->password,
                $usuarioStd->tipo
            );
            return $usuario;
        } else {
            return null;
        }
    }
}
