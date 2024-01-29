<?
function textovacio($name)
{
    if (empty($_REQUEST[$name])) {
        return true;
    }
    return false;
}

//funciones para validar el login
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
//funciones para validar registro
function validarFormularioReg(&$errores)
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
function comUsuario(&$errores)
{
    if (textoVacio('usuarioReg')) {
        $errores['usuarioReg'] = "este campo esta vacio";
    } elseif (UsuarioDao::repetido($_REQUEST['usuarioReg'])) {
        $errores['usuarioReg'] = "usuario repetido";
    }
}
function comNombre(&$errores)
{
    if (textoVacio('nombreReg')) {
        $errores['nombreReg'] = "este campo esta vacio";
    }
}

function comContra(&$errores)
{
    $contra = $_REQUEST['contraReg'] ?? '';
    $repContra = $_REQUEST['repContraReg'] ?? '';

    if (empty($contra) || empty($repContra)) {
        if (empty($contra)) {
            $errores['contraReg'] = "Este campo está vacío";
        }
        if (empty($repContra)) {
            $errores['repContraReg'] = "Este campo está vacío";
        }
    } else {
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/', $contra)) {
            $errores['contraReg'] = "La contraseña debe contener al menos una minúscula, una mayúscula y un dígito";
        } elseif ($contra !== $repContra) {
            $errores['contraReg'] = "Las contraseñas no coinciden";
            $errores['repContraReg'] = "Las contraseñas no coinciden";
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
        $errores['fechaReg'] = "formato incorrecto.";
        return false;
    }
    $_REQUEST['fechaReg'] = $anio . '-' . $mes . '-' . $dia;
}
function comFecha(&$errores)
{
    if (textoVacio('fechaReg')) {
        $errores['fechaReg'] = "este campo esta vacio";
    } elseif (preg_match('/^(\d{1,2})(\/)(\d{1,2})(\/)(\d{2}|\d{4})$/', $_REQUEST['fechaReg'])) {
        global $fechaNueva;
        $fechaNueva = preg_replace_callback('/(\d{1,2})(\/)(\d{1,2})(\/)(\d{2,4})/', 'corrige', $_REQUEST['fechaReg']);
        if (comprrueba($fechaNueva, $errores)) {
            $fechaActual = date('d-m-Y');
            $fechaNacimientoObj = new DateTime($fechaNueva);
            $fechaActualObj = new DateTime($fechaActual);
            $diferencia = $fechaNacimientoObj->diff($fechaActualObj);
            $edad = $diferencia->y;
            if ($edad <= 18) {
                $errores['fechaReg'] = "La persona no es mayor de edad.";
            }
        }
    } else {
        $errores['fecha'] = "formato incorrecto.";
    }
}
function comCorreo(&$errores)
{
    if (textoVacio('emailReg')) {
        $errores['emailReg'] = "este campo esta vacio";
    } elseif (!preg_match('/^.+@.+\..{2,}$/', $_REQUEST['emailReg'])) {
        $errores['emailReg'] = "combinacion incorrecta";
    }
}
//funcioones para control de ficher
function registrarse()
{
    if (isset($_REQUEST['Registrarse'])) {
        return true;
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
