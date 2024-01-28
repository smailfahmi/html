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
require('./models/Albaran.php');
require('./models/Categoria.php');
require('./models/Pedido.php');
require('./models/Perfil.php');
require('./models/Productos.php');
require('./models/Usuario.php');

//DAOS
require('./dao/AlbaranDAO.php');
require('./dao/CategoriaDAO.php');
require('./dao/PedidoDAO.php');
require('./dao/PerfilDAO.php');
require('./dao/ProductoDAO.php');
require('./dao/UsuarioDAO.php');
