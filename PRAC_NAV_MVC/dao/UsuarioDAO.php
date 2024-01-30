<?
class UsuarioDao
{

    public static function findAll()
    {
        $sql = "SELECT * FROM Usuarios";
        $parametros = array();
        $result = FactoryBd::realizarConsulta($sql, $parametros);
        $array_usuarios = array();
        while ($usuarioStd = $result->fetchObject()) {
            $usuario = new Usuario(
                $usuarioStd->id,
                $usuarioStd->usuario,
                $usuarioStd->clave,
                $usuarioStd->nombre,
                $usuarioStd->correo,
                $usuarioStd->perfil,
                $usuarioStd->fecha_nacimiento,

            );
            array_push($array_usuarios, $usuario);
        }

        return $array_usuarios;
    }
    public static function findById($id)
    {
        $sql = "SELECT * FROM Usuarios WHERE id = ?";
        $parametros = array($id);
        $result = FactoryBd::realizarConsulta($sql, $parametros);
        if ($result->rowCount() == 1) {
            $usuarioStd = $result->fetchObject();
            $usuario = new Usuario(
                $usuarioStd->id,
                $usuarioStd->usuario,
                $usuarioStd->clave,
                $usuarioStd->nombre,
                $usuarioStd->correo,
                $usuarioStd->perfil,
                $usuarioStd->fecha_nacimiento,

            );
            return $usuario;
        } else
            return null;
    }
    public static function insert($usuario)
    {
        $sql = "INSERT INTO Usuarios (id, usuario,clave, nombre,correo,perfil,fecha_nacimiento)VALUES (?, ?, ?, ?, ?, ?,?)";
        $parametros = array(
            $usuario->id,
            $usuario->usuario,
            $usuario->clave,
            $usuario->nombre,
            $usuario->correo,
            $usuario->perfil,
            $usuario->fecha_nacimiento,

        );
        $result = FactoryBd::realizarConsulta($sql, $parametros);
        return true;
    }
    public static function update($usuario)
    {
        $sql = "UPDATE Usuarios SET  usuario=?,clave=?, nombre=? ,correo=?,perfil=?,fecha_nacimiento=? WHERE id=?";
        $parametros = array(

            $usuario->usuario,
            $usuario->clave,
            $usuario->nombre,
            $usuario->correo,
            $usuario->perfil,
            $usuario->fecha_nacimiento,
            $usuario->id,
        );

        $result = FactoryBd::realizarConsulta($sql, $parametros);
        return true;
    }

    public static function buscarPorNombre($nombre)
    {
        //return 1 objeto usuario
        $sql = "SELECT * FROM Usuarios WHERE id LIKE ?";
        $nombre = '%' . $nombre . '%';
        $parametros = array($nombre);
        $result = FactoryBD::realizarConsulta($sql, $parametros);

        if ($result->rowCount() == 1) {
            $usuarioStd = $result->fetchObject();
            $usuario = new Usuario(
                $usuarioStd->id,
                $usuarioStd->usuario,
                $usuarioStd->clave,
                $usuarioStd->nombre,
                $usuarioStd->correo,
                $usuarioStd->perfil,
                $usuarioStd->fecha_nacimiento,

            );
            return $usuario;
        } else {
            return null;
        }
    }
    public static function validarUsuario($nombre, $contra)
    {
        //return 1 objeto usuario
        $sql = "SELECT * FROM Usuarios WHERE usuario = ? and clave= ? ";
        $parametros = array($nombre, $contra);
        $result = FactoryBD::realizarConsulta($sql, $parametros);

        if ($result->rowCount() == 1) {
            $usuarioStd = $result->fetchObject();
            $usuario = new Usuario(
                $usuarioStd->id,
                $usuarioStd->usuario,
                $usuarioStd->clave,
                $usuarioStd->nombre,
                $usuarioStd->correo,
                $usuarioStd->perfil,
                $usuarioStd->fecha_nacimiento,

            );
            return $usuario;
        } else {
            return null;
        }
    }
    public static function repetido($nombre)
    {
        $sql = 'SELECT usuario FROM Usuarios WHERE usuario = ?';
        $parametros = array($nombre);
        $result = FactoryBD::realizarConsulta($sql, $parametros);

        $usuario = $result->fetchObject();

        if ($usuario) {
            return true; // El usuario existe
        } else {
            return false; // El usuario no existe
        }
    }
}
