<?
//constantes que vamos usar en la app
// define('IMG', './webroot/img/');
// define('CSS', './webroot/css/');
// define('JS', './webroot/js/');
define('VIEW', './views/');
define('CON', './controllers/');

//RECURSOS BD
require('./config/confiBD.php');
require('./dao/FactoryBD.php');

// require('./core/funciones.php');

//MODELOS
require('./models/Albaran.php');
require('./models/Categoria.php');

//DAOS
require('./dao/AlbaranDAO.php');
require('./dao/CategoriaDAO.php');



// require('./models/Cita.php');
// require('./dao/CitaDao.php');
