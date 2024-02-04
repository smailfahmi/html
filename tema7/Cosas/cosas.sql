create database cosas;

CREATE TABLE usuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    perfil VARCHAR(50) NOT NULL,
    contra VARCHAR(255) NOT NULL,
    activo BOOLEAN NOT NULL
);

DROP USER IF EXISTS cosas;
CREATE USER cosas IDENTIFIED BY 'cosas';
GRANT ALL ON cosas.* TO cosas;