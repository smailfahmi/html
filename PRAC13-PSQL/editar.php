<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?
    $errores = [];
    include('./funcionesBD_PSQL.php');
    if (isset($_REQUEST['editar']) && valido($errores)) {
        if (empty($_REQUEST['ID']) && $_REQUEST['editar'] == 'EDITAR') { //en el caso que no tenga id es porque estamos en la opcion de añadir 
            aniadirvalor($_REQUEST['BD']);
        }
        if (!empty($_REQUEST['ID']) && $_REQUEST['editar'] == 'EDITAR') { //si no esta vacio el id editamos la linea con los valores recogido en los inputs 
            editarvalor($_REQUEST['BD'], $_REQUEST['ID']);
        }
    } elseif (isset($_REQUEST['volver'])) {
        if ($_REQUEST['volver'] == 'VOLVER') {
            header('Location: ./index.php');
        }
    } else {
    ?>
        <form action="" method="get">
            <p>Empresa: <input type="text" name="empresa" value="<? if (isset($_REQUEST['empresa']))
                                                                        echo $_REQUEST['empresa']; //similar a la funcion recuerda pero mas guarreras
                                                                    elseif (isset($_REQUEST['id'])) //si paso id quiere decir que tenfgo que rellenar el imnput con el valor de la columna de la bd
                                                                        rellenar($_REQUEST['id'], 'trabajos', 'empresa'); ?>" id=""> <? if (isset($errores['empresa']))
                                                                                                                                            echo $errores['empresa']; //escribe el error 
                                                                                                                                        ?></p>
            <p>Meses: <input type="text" name="meses" value="<? if (isset($_REQUEST['meses']))
                                                                    echo $_REQUEST['meses'];
                                                                elseif (isset($_REQUEST['id']))
                                                                    rellenar($_REQUEST['id'], 'trabajos', 'meses'); ?>" id=""><? if (isset($errores['meses']))
                                                                                                                                    echo $errores['meses']; ?></p>
            <p>Fecha: <input type="text" name="fecha" value="<? if (isset($_REQUEST['fecha']))
                                                                    echo $_REQUEST['fecha'];
                                                                elseif (isset($_REQUEST['id']))
                                                                    rellenar($_REQUEST['id'], 'trabajos', 'fecha_entrada'); ?>" id=""><? if (isset($errores['fecha']))
                                                                                                                                            echo $errores['fecha']; ?></p>
            <input type="hidden" name='BD' value="<?
                                                    if (isset($_REQUEST['nombre']) && !isset($_REQUEST['BD'])) { //guardo el nombre de la bd para no perderlo incluso cuando el formulario no se valide 
                                                        echo $_REQUEST['nombre'];
                                                    } else
                                                        echo $_REQUEST['BD'];
                                                    ?>">
            <input type="hidden" name='ID' value="<?
                                                    if (isset($_REQUEST['id']) && !isset($_REQUEST['ID'])) { //guardo el id de la fila de la bd para no perderlo incluso cuando el formulario no se valide siempre que lo haya pasado porl a url  
                                                        echo $_REQUEST['id'];
                                                    } elseif (isset($_REQUEST['ID']))
                                                        echo $_REQUEST['ID'];
                                                    ?>">
            <p><input type="submit" name="editar" value="EDITAR"></p>
            <p><input type="submit" name="volver" value="VOLVER"></p>
        </form>
    <? } ?>
</body>

</html>