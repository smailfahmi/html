<?
class ProductoDAO
{


    public static function findAll()
    {
        $sql = "SELECT * FROM Productos";
        $parametros = array();
        $result = FactoryBd::realizarConsulta($sql, $parametros);
        $array_productos = array();
        while ($Productos = $result->fetchObject()) {
            $producto = new Productos(
                $Productos->id,
                $Productos->nombre,
                $Productos->precio,
                $Productos->descripcion,
                $Productos->imagen_url,
                $Productos->stock,
                $Productos->categoria_id,
                $Productos->visible

            );
            array_push($array_productos, $producto);
        }

        return $array_productos;
    }
    public static function findById($id)
    {
        $sql = "SELECT * FROM Productos WHERE id = ?";
        $parametros = array($id);
        $result = FactoryBd::realizarConsulta($sql, $parametros);
        if ($result->rowCount() == 1) {
            $Productos = $result->fetchObject();
            $producto = new Productos(
                $Productos->id,
                $Productos->nombre,
                $Productos->precio,
                $Productos->descripcion,
                $Productos->imagen_url,
                $Productos->stock,
                $Productos->categoria_id,
                $Productos->visible

            );
            return $producto;
        } else
            return null;
    }
    public static function insert($producto)
    {
        $sql = "INSERT INTO Productos (id, nombre,precio,descripcion,imagen_url,stock,categoria_id,visible)VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $parametros = array(
            $producto->id,
            $producto->nombre,
            $producto->precio,
            $producto->descripcion,
            $producto->imagen_url,
            $producto->stock,
            $producto->categoria_id,
            $producto->visible
        );
        $result = FactoryBd::realizarConsulta($sql, $parametros);
        if ($result) {
            // La inserción fue exitosa
            return true;
        } else {
            // La inserción falló
            return false;
        }
    }
    public static function update($producto)
    {
        $sql = "UPDATE  Productos SET nombre=?,precio=?,descripcion=?,imagen_url=?,stock=?,categoria_id=?,visible=? WHERE id =?";

        $parametros = array(

            $producto->nombre,
            $producto->precio,
            $producto->descripcion,
            $producto->imagen_url,
            $producto->stock,
            $producto->categoria_id,
            $producto->visible,
            $producto->id
        );
        $result = FactoryBd::realizarConsulta($sql, $parametros);
        if ($result) {
            // La inserción fue exitosa
            return true;
        } else {
            // La inserción falló
            return false;
        }
    }
    public static function delete($producto)
    {
        $sql = "UPDATE Producto SET visible = false WHERE id=?";
        $parametros = array($producto->id);
        $result = FactoryBd::realizarConsulta($sql, $parametros);
        if ($result->rowCount() > 0)
            return true;
    }
    public static function activa($producto)
    {
        $sql = "UPDATE Producto SET visible = true WHERE id=?";
        $parametros = array($producto->id);
        $result = FactoryBd::realizarConsulta($sql, $parametros);
        if ($result->rowCount() > 0)
            return true;
    }
    public static function buscarPorNombre($nombre)
    {
        //return 1 objeto usuario
        $sql = "SELECT * FROM Producto where nombre like ?";
        $nombre = '%' . $nombre . '%';
        $parametros = array($nombre);
        $result = FactoryBD::realizarConsulta($sql, $parametros);

        if ($result->rowCount() == 1) {
            $Productos = $result->fetchObject();
            $producto = new Productos(
                $Productos->id,
                $Productos->nombre,
                $Productos->precio,
                $Productos->descripcion,
                $Productos->imagen_url,
                $Productos->stock,
                $Productos->categoria_id,
                $Productos->visible

            );
            return $producto;
        } else
            return null;
    }
    public static function extraerID($cadena)
    {
        preg_match('/\d+/', $cadena, $matches); // Encuentra una secuencia de uno o más dígitos
        return $matches[0]; // Devuelve el primer número encontrado en la cadena
    }
    public static function compruebastock($producto)
    {
        if ($producto->stock > 0) {
            return $producto;
        } else
            return false;
    }
    public static function cuentaFilas()
    {
        $sql = "SELECT COUNT(*) AS total_filas FROM Productos";
        $parametros = array();
        $result = FactoryBd::realizarConsulta($sql, $parametros);
        $total_filas = 0;

        if ($result) {
            $row = $result->fetch(PDO::FETCH_ASSOC);
            $total_filas = $row['total_filas'];
        }

        return $total_filas;
    }
}
