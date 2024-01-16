<?
require('./config/confi.php');
session_start();
if (isset($_REQUEST['login'])) {
    $_SESSION['vista'] = VIEW . 'login.php';
    $_SESSION['controller'] = CON . 'loginController.php';
} elseif (isset($_REQUEST['home'])) {
    $_SESSION['vista'] = VIEW . 'home.php';
}

require('./views/layout.php');
// echo '<pre>';
// print_r(
//     UserDao::findAll()
// );
// print_r(
//     UserDao::findById('3')
// );
// $usuario = new User('2', sha1('luis'), 'luis', '2024-01-11', 'usuario', true);
// UserDao::update($usuario);
// // $usuario = new User('5', sha1('smail'), 'smail', '2024-01-11', 'usuario', true);
// // UserDao::insert($usuario);
// // $usuario = new User('5', sha1('juana la loca 1'), 'juana la loca 1', '2024-01-11', 'usuario', true);
// // UserDao::delete($usuario);
// print_r(UserDao::buscarPorNombre('lu'));
// print_r(UserDao::validarUsuario('luis','luis'));
