<?
class CategoriaDAO
{

    public static function findAll()
    {
        $sql = "SELECT * FROM Categorias";
        $parametros = array();
        $result = FactoryBd::realizarConsulta($sql, $parametros);
        $array_categoria = array();
        while ($Categorias = $result->fetchObject()) {
            $categoria = new Categoria(
                $Categorias->id,
                $Categorias->nombre
            );
            array_push($array_categoria, $categoria);

        }

        return $array_categoria;
    }
    public static function findById($id)
    {
        $sql = "SELECT * FROM Categorias WHERE id = ?";
        $parametros = array($id);
        $result = FactoryBd::realizarConsulta($sql, $parametros);
        if ($result->rowCount() == 1) {
            $Categorias = $result->fetchObject();
            $categoria = new Categoria(
                $Categorias->id,
                $Categorias->nombre


            );
            return $categoria;
        } else
            return null;


    }
    public static function insert($categoria)
    {
        $sql = "INSERT INTO Categorias (id, nombre)VALUES (?, ?)";
        $parametros = array(
            $categoria->id,
            $categoria->nombre
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
    public static function update($categoria)
    {
        $sql = "UPDATE  Categorias SET nombre=? WHERE id =?";
        $parametros = array(
            $categoria->nombre,
            $categoria->id
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

}