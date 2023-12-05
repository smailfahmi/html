 DROP DATABASE IF EXISTS hola;
create database hola;
DROP USER IF EXISTS hola;
create user hola identified by 'SmailSmail';
use hola;
grant all on hola.* to hola;