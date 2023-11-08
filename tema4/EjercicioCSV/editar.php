<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?

    if (isset($_REQUEST['escribir'])) {
        print_r($_REQUEST);
    }else{

        $dates = [];
        $fila = 0;
        if (($gestor = fopen("notas.csv", "r")) !== FALSE) {
            while (($datos = fgetcsv($gestor, 1000, ";")) !== FALSE) {
                $numero = count($datos);
                $conta = 0;
                for ($c = 0; $c < $numero; $c++) {
                    if ($fila == (int)$_REQUEST['nom']) {
                        $dates[$conta] =  $datos[$conta];
                        $conta++;
                    }
                }
                $fila++;
            }
            fclose($gestor);
        }
    ?>
    <form action="" method="get">
        <p><label for="">nombre: <input type="text" value="<?
                                                            echo $dates[0] ?>" name="nombre"></label></p>
        <p><label for="">nombre: <input type="text" value="<?
                                                            echo $dates[1] ?>" name="nota1"></label></p>
        <p><label for="">nombre: <input type="text" value="<?
                                                            echo $dates[2] ?>" name="nota2"></label></p>
        <p><label for="">nombre: <input type="text" value="<?
                                                            echo $dates[3] ?>" name="nota3"></label></p>
        <p>
            <label for="Leer">
                <input type="submit" value="volver" name="volver">
            </label>
            <label for="Escribir">
                <input type="submit" value="modificar" name="modificar">
            </label>
        </p>
    </form>
    <?}?>
</body>

</html>