<?
class PedidoDAO
{

    public static function findAll()
    {
        $sql = "SELECT * FROM Pedidos";
        $parametros = array();
        $result = FactoryBd::realizarConsulta($sql, $parametros);
        $array_pedidos = array();
        while ($Pedidos = $result->fetchObject()) {
            $pedido = new Pedido(
                $Pedidos->id,
                $Pedidos->producto_id,
                $Pedidos->usuario_id,
                $Pedidos->cantidad,
                $Pedidos->fecha_pedido

            );
            array_push($array_pedidos, $pedido);

        }

        return $array_pedidos;
    }
    public static function findById($id)
    {
        $sql = "SELECT * FROM Pedidos WHERE id = ?";
        $parametros = array($id);
        $result = FactoryBd::realizarConsulta($sql, $parametros);
        if ($result->rowCount() == 1) {
            $Pedidos = $result->fetchObject();
            $pedido = new Pedido(
                $Pedidos->id,
                $Pedidos->producto_id,
                $Pedidos->usuario_id,
                $Pedidos->cantidad,
                $Pedidos->fecha_pedido

            );
            return $pedido;
        } else
            return null;


    }
    public static function insert($pedido)
    {
        $sql = "INSERT INTO Pedidos (id, producto_id,usuario_id, cantidad,fecha_pedido)VALUES (?, ?, ?, ?, ?)";
        $parametros = array(
            $pedido->id,
            $pedido->producto_id,
            $pedido->usuario_id,
            $pedido->cantidad,
            $pedido->fecha_pedido
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
    public static function update($pedido)
    {
        $sql = "UPDATE  Pedidos SET producto_id=?,usuario_id=?, cantidad=?,fecha_pedido=? WHERE id =?";

        $parametros = array(
            $pedido->producto_id,
            $pedido->usuario_id,
            $pedido->cantidad,
            $pedido->fecha_pedido,
            $pedido->id
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