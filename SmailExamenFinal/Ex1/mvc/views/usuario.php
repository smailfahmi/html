<?
if (isset($resultado)) {
    echo $resultado;
}
?>
<form action="" method="post">

    <input type="submit" name="CerrarSesion" value="Cerrar sesion">
    <br>
    <input type="submit" name="ParidaAleatoria" value="Nueva Partida">
    <br>
    <label for="">
        <input type="text" name="letras" id="">
        <?php if (isset($errores)) {
            escribirErrores($errores, "numerico");     # code...
        }
        ?>
        <input type="submit" name="ParidaAleatoriaMinima" value="Nueva Partida Minima">
    </label>
</form>