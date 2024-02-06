<?

// print_r(implode($_SESSION['palabra']));s

print_r(implode($_SESSION['oculto']));
echo '<br>';
echo 'numeros de errores = ';

print_r($_SESSION['errores']);
echo '<br>';
?>
<form action="" method="post">

  <input type="submit" name="CerrarSesion" value="Cerrar sesion">
  <br>
  <label for="">
    <input type="text" name="letras" id="">
    <input type="submit" name="pruebaLetra" value="Probar Letra">
  </label>
</form>