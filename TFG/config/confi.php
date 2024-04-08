<?
//constantes que vamos usar en la app
// define('IMG', './webroot/img/');
// define('CSS', './webroot/css/');
// define('JS', './webroot/js/');
define('VIEW', './views/');
define('CON', './controllers/');
define('IMG', './public/');
define('FOOTER', './public/fragmentos/footer.php');
define('HEADER', './public/fragmentos/header.php');

//RECURSOS BD
require('./config/confiBD.php');
require('./dao/FactoryBD.php');

//FUNCIONES
require('./core/funciones.php');
require('./core/funcionesLogin.php');

//MODELOS
require('./models/DatosUsuario.php');
require('./models/DetalleRutina.php');
require('./models/Ejercicios.php');
require('./models/Rutina.php');
require('./models/Usuario.php');

//DAOS
require('./dao/RutinaDAO.php');
require('./dao/EjerciciosDAO.php');
require('./dao/DatosUsuarioDAO.php');
require('./dao/DetalleRutinaDAO.php');
require('./dao/UsuarioDAO.php');

//CONTROLES
require('./controllers/UsuariosController.php');