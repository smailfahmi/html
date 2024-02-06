<?
//constantes que vamos usar en la app
define('IMG', './webroot/img/');
define('CSS', './webroot/css/');
define('JS', './webroot/js/');
define('VIEW', './views/');
define('CON', './controllers/');
define("URI_API", 'http://192.168.7.205/SmailExamenFinal/Ex2/api/index/');

require('./core/funciones.php');
require('./config/confiBD.php');
require('./dao/FactoryBD.php');
require('./models/Usuarios.php');
require('./dao/UsuarioDao.php');
require('./models/Palabras.php');
require('./dao/PalabraDao.php');
require('./models/Estadisticas.php');
require('./dao/EstadisticaDao.php');
