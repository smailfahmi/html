<?
include('./funcLogin.php');
session_start();
if (enviado() && !textoVacio('usuario') && !textoVacio('contraseña')) {
    $usuario = validaUsuari($_REQUEST['usuario'], $_REQUEST['contraseña']);
    if ($usuario) {
        $_SESSION['usuario'] = $usuario;
        header('Location:./index.php');
    } else {
        echo 'false';
    }
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>El título de tu página</title>
</head>

<body>




    <div class="container">
        <div class="row justify-content-center p-2">
            <div class="home col-md-4 text-center d-flex justify-content-center align-items-center">
                <h1> SMAILSHOP</h1>
                <img src="./imagenes/images.jpg" alt="" style="border-radius: 50%; height: 75px; width: 75px;">
            </div>
        </div>
        <div class="row justify-content-center">
            <!-- Formulario de Login -->
            <div class="col-md-6">
                <div class="card p-3">
                    <h3 class="mb-4">Inicio de Sesión</h3>
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="usuario" class="form-label">Usuario</label>
                            <input type="text" class="form-control" id="usuario" name="usuario" required>
                        </div>
                        <div class="mb-3">
                            <label for="contraseña" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="contraseña" name="contraseña" required>
                        </div>
                        <input type="submit" class="btn btn-dark" value="Iniciar" name="Iniciar"></input>
                    </form>

                </div>

            </div>

            <!-- Formulario de Registro -->
            <div class="col-md-6">
                <div class="card p-3">
                    <h3 class="mb-4">Registro</h3>
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre Usuario</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="contraseña" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="contraseña" name="contraseña" required>
                        </div>
                        <div class="mb-3">
                            <label for="repContraseña" class="form-label">Repite Contraseña</label>
                            <input type="password" class="form-control" id="repContraseña" name="repContraseña"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="fecha" class="form-label">Fecha Nacimiento</label>
                            <input type="password" class="form-control" id="fecha" name="fecha" placeholder="dd/mm/aaaa"
                                required>
                        </div>
                        <input type="submit" class="btn btn-dark" value="Registrarse"></input>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <!-- JavaScript para bootstrap -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
        crossorigin="anonymous"></script>
    <script src="./js/login.js"></script>
</body>

</html>