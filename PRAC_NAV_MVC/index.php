<?
echo '<pre>';
require('./config/confi.php');

$albaran = CategoriaDAO::findById(1);
print_r($albaran);
$albaran->nombre = 'Abrigos';
CategoriaDAO::update($albaran);
print_r(CategoriaDAO::findById(1));
$albaran->id = null;
CategoriaDAO::insert($albaran);
print_r(CategoriaDAO::findAll());