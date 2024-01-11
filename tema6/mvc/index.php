<?
require('./config/confi.php');
echo '<pre>';
print_r(
    UserDao::findAll()
);
print_r(
    UserDao::findById('1')
);

$usuario = new User('3', sha1('lucia'), 'lucia', '2024-01-11', 'usuario');
UserDao::insert($usuario);
