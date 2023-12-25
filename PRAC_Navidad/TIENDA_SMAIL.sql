-- Crear la base de datos
CREATE DATABASE IF NOT EXISTS tienda;
USE tienda;

-- Crear tabla de Perfil
CREATE TABLE Perfil (
    codigo CHAR(5) PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL
);

-- Insertar roles iniciales
INSERT INTO Perfil (codigo, nombre) VALUES ('USR', 'Usuario'), ('ADM', 'Administrador'), ('MOD', 'Moderador');

-- Crear tabla de Usuarios
CREATE TABLE Usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario CHAR(20) NOT NULL,
    clave CHAR(40) NOT NULL,
    nombre VARCHAR(75) NOT NULL,
    correo VARCHAR(75) NOT NULL,
    perfil CHAR(5) NOT NULL,
    fecha_nacimiento DATE,
    FOREIGN KEY (perfil) REFERENCES Perfil(codigo)
);

-- Crear tabla de Productos
CREATE TABLE Productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    precio DECIMAL(10, 2) NOT NULL,
    descripcion TEXT,
    imagen_url VARCHAR(255),
    stock INT NOT NULL
);

-- Crear tabla de Pedidos
CREATE TABLE Pedidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    producto_id INT,
    usuario_id INT,
    cantidad INT NOT NULL,
    fecha_pedido TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (producto_id) REFERENCES Productos(id),
    FOREIGN KEY (usuario_id) REFERENCES Usuarios(id)
);

-- Crear tabla de Albaran
CREATE TABLE Albaran (
    id INT AUTO_INCREMENT PRIMARY KEY,
    producto_id INT,
    administrador_id INT,
    cantidad_anadida INT NOT NULL,
    fecha_albaran TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (producto_id) REFERENCES Productos(id),
    FOREIGN KEY (administrador_id) REFERENCES Usuarios(id)
);
