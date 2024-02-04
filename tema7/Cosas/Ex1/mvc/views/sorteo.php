<form action="" method="post">
    <input type="submit" name="CerrarSesion" value="Cerrar sesion">
</form>

<?
if (isset($_REQUEST['editarUltima'])) {
    echo '<form action="" method="post">';
    for ($i = 1; $i < 51; $i++) {
        $guardar = '';
        $nombre = "opcion" . $i;
        if (in_array($i, $numeros)) {
            $guardar = 'checked';
        }

        echo '<label for=""><input ' . $guardar . ' type="checkbox" name="opcionCh[]" id="' . $nombre . '"  value="' . $i . '" >' . $i . '</label>';
        // echo ' <br>';
    }
    echo '<br>';
    if (isset($errores)) {
        escribirErrores($errores, "opcionCh");
    }
    echo '<input type="submit" name="editar" value="Editar">';
    echo '</form>';
} else {
    echo '<form action="" method="post">';
    for ($i = 1; $i < 51; $i++) {
        $nombre = "opcion" . $i;
        $guardar = recuerdaChek('opcionCh', $nombre);
        echo '<label for=""><input ' . $guardar . ' type="checkbox" name="opcionCh[]" id="' . $nombre . '"  value="' . $i . '" >' . $i . '</label>';
        // echo ' <br>';
    }
    echo '<br>';
    if (isset($errores)) {
        escribirErrores($errores, "opcionCh");
    }
    echo '<input type="submit" name="Mandar" value="Mandar">';
    echo '<input type="submit" name="editarUltima" value="Editar Ultima">';
    echo '</form>';
}
