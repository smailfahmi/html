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

    <div class="home col-md-4 col-sm-12 col-xs-12 text-center d-flex justify-content-center align-items-center">
        <h1> SMAILSHOP</h1>
        <img src="./imagenes/images.jpg" alt="" style="border-radius: 50%; height: 75px; width: 75px;">
    </div>
    <div class="container">

        <div class="row justify-content-center">
            <!-- Formulario de Login -->
            <div class="col-md-6">
                <div class="card p-3">
                    <h3 class="mb-4">Inicio de Sesión</h3>
                    <form>
                        <div class="mb-3">
                            <label for="loginEmail" class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control" id="loginEmail" required>
                        </div>
                        <div class="mb-3">
                            <label for="loginPassword" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="loginPassword" required>
                        </div>
                        <input type="submit" class="btn btn-dark" value="Iniciar Sesión"></input>
                    </form>

                </div>

            </div>

            <!-- Formulario de Registro -->
            <div class="col-md-6">
                <div class="card p-3">
                    <h3 class="mb-4">Registro</h3>
                    <form>
                        <div class="mb-3">
                            <label for="registerName" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="registerName" required>
                        </div>
                        <div class="mb-3">
                            <label for="registerEmail" class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control" id="registerEmail" required>
                        </div>
                        <div class="mb-3">
                            <label for="registerPassword" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="registerPassword" required>
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