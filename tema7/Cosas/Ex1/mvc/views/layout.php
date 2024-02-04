<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <header>
    </header>
    <nav>

    </nav>
    <main>
        <?
        if (!isset($_SESSION['vista'])) {
        ?>
            <div class="col-md-6">
                <div class="card p-3">
                    <h3 class="mb-4">Inicio de Sesión</h3>
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="usuario" class="form-label">Usuario</label>
                            <input type="text" class="form-control" id="usuario" name="usuarioLog" value="<? if (isset($arrayRecordar)) {
                                                                                                                echo $arrayRecordar['recUser'];
                                                                                                            } ?>">

                            <?php if (isset($errores)) {
                                escribirErrores($errores, "usuarioLog");     # code...
                            }
                            ?>
                        </div>
                        <div class="mb-3">
                            <label for="contraseña" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="contraseña" name="contraLog" value="<? if (isset($arrayRecordar)) {
                                                                                                                    echo $arrayRecordar['recCont'];
                                                                                                                } ?>">
                            <?php if (isset($errores)) {
                                escribirErrores($errores, "contraLog");   # code...
                            } ?>
                        </div>
                        <input type="submit" class="btn btn-dark" value="Recuerdame" name="Recordar"></input>
                        <input type="submit" class="btn btn-dark" value="Iniciar" name="Iniciar"></input>
                        <input type="submit" class="btn btn-dark m-1" name="CerrarSesion" value="Cerrar sesion">
                    </form>

                    <p> <?php if (isset($errores)) {
                            escribirErrores($errores, "validado");  # code...
                        }  ?></p>
                </div>
            </div><?
                } else
                    require $_SESSION['vista'];
                    ?>
    </main>
    <footer>
        copyrigth
    </footer>
</body>

</html>