<?
// require('./confiBD.php');
// try {
//     $con = mysqli_connect(IP, USER, PASS, 'prueba');
//     echo 'conectado';
//     $rnombre = 'miguel';
//     $redad = 38;
//     //$sql = "insert into alumnos (nombre,edad) values ('$rnombre','$redad')";//esta consulta no es preparada 
//     //consultas preparadas 
//     $sql = "insert into alumnos (nombre,edad) values (?,?)";
//     $stmt = mysqli_prepare($con, $sql);
//     mysqli_stmt_bind_param($stmt,"si", $rnombre, $redad);

//     mysqli_stmt_execute($stmt);
//     // if (!mysqli_query($con, $sql)) {
//     //     echo mysqli_errno($con);
//     // }
//     mysqli_close($con);
// } catch (\Throwable $th) {
//     switch ($th->code) {
//         case '1062':
//             echo 'id repetido';
//             break;

//         default:
//             echo $th->getMessage();
//             break;
//     }
//     // echo mysqli_errno($con);
//     // echo mysqli_connect_errno();
//     // echo mysqli_connect_error();
//     //probamos un par de errores y los guardamos en el switch
//     mysqli_close($con);

// }


//para leeer comentamos lo anterior y para borrar lo mismo 

// require('./confiBD.php');
// try {
//     $con = mysqli_connect(IP, USER, PASS, 'prueba');
//     $sql = 'delete from alumnos where id > 5';
//     $result = mysqli_query($con, $sql);
//     // while ($array = mysqli_fetch_assoc($result)) {
//     //     echo '<pre>';
//     //     print_r($array);
//     // }
//     // while ($array = mysqli_fetch_object($result)) {
//     //     echo '<pre>';
//     //     print_r($array);
//     // }
//     // $array = mysqli_fetch_all($result,MYSQLI_BOTH);
//     //     echo '<pre>';
//     //     print_r($array);

//     // $array = mysqli_fetch_all($result);
//     echo mysqli_affected_rows($con);//me devuelve las lineas que modifica 
//     // echo '<pre>';
//     // print_r($array);

//     mysqli_close($con);
// } catch (\Throwable $th) {
//     switch ($th->code) {
//         case '1062':
//             echo 'id repetido';
//             break;

//         default:
//             echo $th->getMessage();
//             break;
//     }

//     mysqli_close($con);
// }

// realizar update de una base de datos ;
// require('./confiBD.php');
// $con = new mysqli();


// try {
//     $con->connect(IP, USER, PASS, 'prueba');
//     $sql = 'update alumnos set edad =?,nombre=? where id =?';
//     $stmt = $con->stmt_init();
//     $stmt->prepare($sql);
//     $nomber = 'raul';
//     $edad = 3;
//     $id = 2;
//     $stmt->bind_param('isi', $edad,$nomber,$id);
//     $stmt->execute();
//     $con->close();

// } catch (\Throwable $th) {
//     switch ($th->code) {
//         case '1062':
//             echo 'id repetido';
//             break;

//         default:
//             echo $th->getMessage();
//             break;
//     }

//     mysqli_close($con);
// }

require('./confiBD.php');
//meter una base de datos 
$con = new mysqli();
try {
    $con->connect(IP, USER, PASS, 'prueba');
    $script = file_get_contents('./banco.sql');
    $con->multi_query($script);
    $con->close();
} catch (\Throwable $th) {
    switch ($th->code) {
        case '1062':
            echo 'id repetido';
            break;

        default:
            echo $th->getMessage();
            break;
    }

    mysqli_close($con);
}
