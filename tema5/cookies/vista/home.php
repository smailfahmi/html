<?
include('../funciones/funciones.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        td {
            border: solid black 2px;

        }

        table {
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="productos">

        <h1>Producto</h1>
        <table>

            <head>
                <th>nombre</th>
                <th>descripcin</th>
                <th>imagen</th>
                <th>ver</th>
            </head>
            <tbody>
                <?
                $array_prod = findAll();
                foreach ($array_prod as $prod) {
                    echo '<tr>';
                    echo '<td>' . $prod['nombre'] . '</td>';
                    echo '<td>' . substr($prod['descripcion'], 0, 20) . '</td>';
                    echo '<td> <img src="../' . $prod['baja'] . '" > </td>';
                    echo '<td><a href="verProducto.php?id=' . $prod['codigo'] . '"> Ver</a></td>';
                }
                echo '</tr>';
                ?>
            </tbody>
        </table>
    </div>
    <div class="visitados">
        <h2>Ultimos visitados</h2>
        <?
        // print_r($_COOKIE);
        if (!empty($_COOKIE)) {
            foreach ($_COOKIE as $valor) {

                $producto = findId($valor);
                if ($producto) {
                    echo '<img src="../' . $producto['baja'] . '" > ';       # code...
                }
            }
        } else {
            echo ' nada ';
        }

        ?>
    </div>
</body>

</html>