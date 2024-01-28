<?
function validaUsuari($user, $pass)
{
    try {
        $DSN = 'mysql:host=' . IP . ';dbname=tienda';
        $con = new PDO($DSN, USER, PASS);
        // $con = mysqli_connect(IP, USER, PASS, 'sesiones');
        $sql = 'select * from Usuarios where usuario= ? and clave=?';
        $stmt = $con->prepare($sql);
        $result = $stmt->execute(array($user, $pass));
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($usuario) {
            unset($con);
            return $usuario;
        }
        return false;
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        return $usuario;
        unset($con);
    }
}
function enviado()
{
    if (!isset($_REQUEST['Iniciar'])) {
        return false;
    }
    return true;
}
function textovacio($name)
{
    if (empty($_REQUEST[$name])) {
        return true;
    }
    return false;
}
function iniciar()
{
    if (isset($_REQUEST['Iniciar'])) {
        return true;
    }
}
function registrarse()
{
    if (isset($_REQUEST['Registrarse'])) {
        return true;
    }
}
function dff(&$errores)
{
    comUsuario($errores);
    comNombre($errores);
    comContra($errores);
    comFecha($errores);
    comCorreo($errores);
    if (count($errores) == 0) {
        return true;
    } else
        return false;
}
function validarFormularioLog(&$errores)
{
    comNombre1($errores);
    comContra1($errores);

    if (count($errores) == 0) {
        return true;
    } else
        return false;
}
function comNombre1(&$errores)
{
    if (textoVacio('usuarioLog')) {
        $errores['usuarioLog'] = "este campo esta vacio o es erroneo";
    }
}
function comContra1(&$errores)
{
    if (textoVacio('contraLog')) {
        $errores['contraLog'] = "este campo esta vacio o es erroneo";
    }
}
function comUsuario(&$errores)
{
    if (textoVacio('usuario')) {
        $errores['usuario'] = "este campo esta vacio";
    } elseif (repetido()) {
        $errores['usuario'] = "usuario repetido";
    }
}
function comNombre(&$errores)
{
    if (textoVacio('nombre')) {
        $errores['nombre'] = "este campo esta vacio";
    }
}
function repetido()
{

    try {
        $DSN = 'mysql:host=' . IP . ';dbname=tienda';
        $con = new PDO($DSN, 'tienda', 'SmailSmail');
        $sql = 'SELECT usuario FROM Usuarios WHERE usuario = ?';
        $stmt = $con->prepare($sql);
        $stmt->execute(array($_REQUEST['usuario']));
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
            return true; // El usuario existe
        } else {
            return false; // El usuario no existe
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false; // Manejo de errores: Retorna false si hay una excepción
    } finally {
        unset($con);
    }
}
function comContra(&$errores)
{
    $contra = $_REQUEST['contra'] ?? '';
    $repContra = $_REQUEST['repContra'] ?? '';

    if (empty($contra) || empty($repContra)) {
        if (empty($contra)) {
            $errores['contra'] = "Este campo está vacío";
        }
        if (empty($repContra)) {
            $errores['repContra'] = "Este campo está vacío";
        }
    } else {
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/', $contra)) {
            $errores['contra'] = "La contraseña debe contener al menos una minúscula, una mayúscula y un dígito";
        } elseif ($contra !== $repContra) {
            $errores['contra'] = "Las contraseñas no coinciden";
            $errores['repContra'] = "Las contraseñas no coinciden";
        }
    }
}

function corrige($coincide)
{
    if ($coincide[1] < 10 && strlen($coincide[1]) != 2) {
        $coincide[1] = '0' . $coincide[1];
    }
    if ($coincide[3] < 10 && strlen($coincide[3]) != 2) {
        $coincide[3] = '0' . $coincide[3];
    }
    if ($coincide[5] <= 23) {
        $coincide[5] = '20' . $coincide[5];
    } elseif ($coincide[5] > 23 && $coincide[5] < 100) {
        $coincide[5] = '19' . $coincide[5];
    }

    return $coincide[1] . $coincide[2] . $coincide[3] . $coincide[4] . $coincide[5];
}
function comprrueba($fechaNueva, &$errores)
{
    $dia = substr($fechaNueva, 0, 2);
    $mes = substr($fechaNueva, 3, 2);
    $anio = substr($fechaNueva, 6, 4);
    if ($dia > 31 || $mes > 12 || $anio > 2023) {
        $errores['fecha'] = "formato incorrecto.";
        return false;
    }
    $_REQUEST['fecha'] = $anio . '-' . $mes . '-' . $dia;
}
function comFecha(&$errores)
{
    if (textoVacio('fecha')) {
        $errores['fecha'] = "este campo esta vacio";
    } elseif (preg_match('/^(\d{1,2})(\/)(\d{1,2})(\/)(\d{2}|\d{4})$/', $_REQUEST['fecha'])) {
        global $fechaNueva;
        $fechaNueva = preg_replace_callback('/(\d{1,2})(\/)(\d{1,2})(\/)(\d{2,4})/', 'corrige', $_REQUEST['fecha']);
        if (comprrueba($fechaNueva, $errores)) {
            $fechaActual = date('d-m-Y');
            $fechaNacimientoObj = new DateTime($fechaNueva);
            $fechaActualObj = new DateTime($fechaActual);
            $diferencia = $fechaNacimientoObj->diff($fechaActualObj);
            $edad = $diferencia->y;
            if ($edad <= 18) {
                $errores['fecha'] = "La persona no es mayor de edad.";
            }
        }
    } else {
        $errores['fecha'] = "formato incorrecto.";
    }
}
function comCorreo(&$errores)
{
    if (textoVacio('email')) {
        $errores['email'] = "este campo esta vacio";
    } elseif (!preg_match('/^.+@.+\..{2,}$/', $_REQUEST['email'])) {
        $errores['email'] = "combinacion incorrecta";
    }
}
function escribirErrores($errores, $name)
{

    if (isset($errores[$name])) {
        echo '<span style="color: red;">' . $errores[$name] . '</span>';
    }
}
function escribirNombre($name)
{
    if (registrarse() && !empty($_REQUEST[$name])) {
        echo $_REQUEST[$name];
    }
}
