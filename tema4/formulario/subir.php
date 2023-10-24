<?php
if (count($_FILES) != 0) {
    print_r($_FILES);
    $ruta='/var/www/html/tema4/';
    $ruta.=basename($_FILES['fichero']['name']);
}
