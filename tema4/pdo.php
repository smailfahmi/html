<?php
//SELECT 
require('./confiBD.php');
$DSN = 'pgsql:host=' . IP . ';dbname=prueba';
// try {
//     $con = new PDO($DSN, USER, PASS);
//     $sql = 'select * from tiempo';
//     $result = $con->query($sql);
//     while ($row = $result->fetch(PDO::FETCH_BOTH)) {
//         echo '<BR>EL TIEMPO DE HOY ' . $row[1] . ' Y HACE ' . $row['grados'];
//     }
// } catch (PDOException $e) {
//     echo $e->getMessage();
// } finally {
//     unset($con);
// }

try {
    $con = new PDO($DSN, USER, PASS);
    $sql = 'select * from tiempo WHERE GRADOS < 10';
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $stmt->bindColumn(2, $desc);
    $stmt->bindColumn(3, $grados);
    while ($row = $stmt->fetch(PDO::FETCH_BOTH)) {
        echo '<BR>EL TIEMPO DE HOY ' . $row[1] . ' Y HACE ' . $row[2] . 'º';
    }
} catch (PDOException $e) {
    echo $e->getMessage();
} finally {
    unset($con);
}

// INSERTAR E
// try {
//     $con = new PDO($DSN, USER, PASS);
//     $sql = 'insert into tiempo(descripcion,grados)values(?,?)';
//     $stmt = $con->prepare($sql);
//     $stmt->execute(array('soleado', 35));

// } catch (PDOException $e) {
//     echo $e->getMessage();
// }

// try {
//     $con = new PDO($DSN, USER, PASS);
//     $sql = 'insert into tiempo(descripcion,grados)values(:desc,:grad)';
//     $stmt = $con->prepare($sql);
//     $lluevia = 'lluevia';
//     $grados = 20;
//     $stmt->bindParam(':desc', $lluevia);
//     $stmt->bindParam(':grad', $grados);
//     $stmt->execute();
// } catch (PDOException $e) {
//     echo $e->getMessage();
// }

