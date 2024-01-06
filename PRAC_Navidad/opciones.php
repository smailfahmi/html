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
    <?
    include('./funcionesBD.php');
    session_start();
    if (!isset($_SESSION['usuario'])) {
        $_SESSION['error'] = 'no tiene permisos';
        header('Location: ./login.php');
        exit;
    } else {
        ?>
        <div class="container">
            <div class="row justify-content-center p-2">
                <div class="home col-md-4 text-center d-flex justify-content-center align-items-center">
                    <h1> SMAILSHOP</h1>
                    <img src="./imagenes/images.jpg" alt="" style="border-radius: 50%; height: 75px; width: 75px;">
                </div>
            </div>
            <?
            if (isset($_REQUEST['Guardar'])) {
                updatear();
            }
            ?>
            <div class="container mt-5">
                <h2>Modificar Usuario</h2>
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label">Nombre de Usuario</label>
                        <input type="text" class="form-control" name="usuario" readonly
                            value="<? echo $_SESSION['usuario']['usuario'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="contra" required
                            value="<? echo $_SESSION['usuario']['clave'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="name" name="nombre" required
                            value="<? echo $_SESSION['usuario']['nombre'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" required
                            value="<? echo $_SESSION['usuario']['correo'] ?>">
                    </div>
                    <div class="mb-3">
                        <label for="birthdate" class="form-label">Fecha de Nacimiento</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" required readonly
                            value="<? echo $_SESSION['usuario']['fecha_nacimiento'] ?>">
                    </div>
                    <div class="row">
                        <input type="submit" class="btn btn-dark m-1" name="Guardar" value="Guardar Cambios">
                        <a href="./index.php" class="btn btn-dark m-1">Salir</a>
                        <a href="./logOut.php" class="btn btn-dark m-1">Cerrar sesion</a>
                    </div>
                    </input>
                </form>
            </div>


        <? }
    ?>



        <!-- JavaScript para bootstrap -->
        <script src="https://code.jquery.com/jquery-3.7.0.min.js"
            integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm"
            crossorigin="anonymous"></script>
        <script src="./js/login.js"></script>
</body>

</html>