CREATE DATABASE IF NOT EXISTS tienda;

USE tienda;

CREATE TABLE Perfil (
    codigo CHAR(5) PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL
);

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

CREATE TABLE Categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL
);

CREATE TABLE Productos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre CHAR(20) NOT NULL,
    precio DECIMAL(10, 2) NOT NULL,
    descripcion TEXT,
    imagen_url VARCHAR(255),
    stock INT NOT NULL,
    categoria_id INT,
    visible TINYINT(1) DEFAULT 1,
    -- Agregar una columna booleana con valor predeterminado "verdadero" (1)
    FOREIGN KEY (categoria_id) REFERENCES Categorias(id)
);

CREATE TABLE Pedidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    producto_id INT,
    usuario_id INT,
    cantidad INT NOT NULL,
    fecha_pedido TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (producto_id) REFERENCES Productos(id),
    FOREIGN KEY (usuario_id) REFERENCES Usuarios(id)
);

CREATE TABLE Albaran (
    id INT AUTO_INCREMENT PRIMARY KEY,
    producto_id INT,
    administrador_id INT,
    cantidad_anadida INT NOT NULL,
    fecha_albaran TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (producto_id) REFERENCES Productos(id),
    FOREIGN KEY (administrador_id) REFERENCES Usuarios(id)
);

INSERT INTO
    Perfil (codigo, nombre)
VALUES
    ('USR', 'Usuario'),
    ('ADM', 'Administrador'),
    ('MOD', 'Moderador');

INSERT INTO
    Categorias (nombre)
VALUES
    ('abrigos'),
    ('sudaderas'),
    ('camisetas'),
    ('jeans'),
    ('chandals'),
    ('calzoncillos'),
    ('calcetines'),
    ('zapatillas');

INSERT INTO
    Usuarios (
        usuario,
        clave,
        nombre,
        correo,
        perfil,
        fecha_nacimiento
    )
VALUES
    (
        'usuario1',
        'clave1',
        'Nombre Usuario 1',
        'usuario1@example.com',
        'USR',
        '1990-01-01'
    ),
    (
        'admin',
        'adminpass',
        'Administrador',
        'admin@example.com',
        'ADM',
        '1985-05-15'
    ),
    (
        'moderador',
        'modpass',
        'Moderador',
        'moderador@example.com',
        'MOD',
        '1995-12-20'
    );

INSERT INTO
    Productos (
        precio,
        nombre,
        descripcion,
        imagen_url,
        stock,
        categoria_id,
        visible
    )
VALUES
    (
        99.99,
        'CHAQUETON 1',
        'abrigo con forro polar y plumas interiores',
        './imagenes/prod/abrigo1.jpg',
        2,
        1,
        1
    ),
    (
        99.99,
        'CHAQUETON 2',
        'abrigo con forro polar y plumas interiores',
        './imagenes/prod/abrigo2.jpg',
        2,
        1,
        1
    ),
    (
        99.99,
        'CHAQUETON 3',
        'abrigo con forro polar y plumas interiores',
        './imagenes/prod/abrigo3.jpg',
        2,
        1,
        1
    ),
    -- Asignado a la categoría 'abrigos' (ID 1)
    (
        99.99,
        'SUDADERA 1',
        'sudadera de color gris',
        './imagenes/prod/sudadera1.jpg',
        2,
        2,
        1
    ),
    (
        99.99,
        'SUDADERA 2',
        'sudadera de color gris',
        './imagenes/prod/sudadera2.jpg',
        2,
        2,
        1
    ),
    (
        99.99,
        'SUDADERA 3',
        'sudadera de color gris',
        './imagenes/prod/sudadera3.jpg',
        2,
        2,
        1
    ),
    -- Asignado a la categoría 'sudaderas' (ID 2)
    (
        99.99,
        'CAMISETA 1',
        'camiseta de color gris',
        './imagenes/prod/camiseta1.jpg',
        2,
        3,
        1
    ),
    (
        99.99,
        'CAMISETA 2',
        'camiseta de color gris',
        './imagenes/prod/camiseta2.jpg',
        2,
        3,
        1
    ),
    (
        99.99,
        'CAMISETA 3',
        'camiseta de color gris',
        './imagenes/prod/camiseta3.jpg',
        2,
        3,
        1
    ),
    -- Asignado a la categoría 'sudaderas' (ID 3)
    (
        99.99,
        'JEANS 1',
        'jeans de color gris',
        './imagenes/prod/jeans1.jpg',
        2,
        4,
        1
    ),
    (
        99.99,
        'JEANS 2',
        'jeans de color gris',
        './imagenes/prod/jeans2.jpg',
        2,
        4,
        1
    ),
    (
        99.99,
        'JEANS 3',
        'jeans de color gris',
        './imagenes/prod/jeans3.jpg',
        2,
        4,
        1
    ),
    -- Asignado a la categoría 'jeans' (ID 4)
    (
        99.99,
        'CHANDAL 1',
        'chandal de color gris',
        './imagenes/prod/chandal1.jpg',
        2,
        5,
        1
    ),
    (
        99.99,
        'CHANDAL 2',
        'chandal de color gris',
        './imagenes/prod/chandal2.jpg',
        2,
        5,
        1
    ),
    (
        99.99,
        'CHANDAL 3',
        'chandal de color gris',
        './imagenes/prod/chandal3.jpg',
        2,
        5,
        1
    ),
    -- Asignado a la categoría 'chandals' (ID 5)
    (
        99.99,
        'CALZON 1',
        'calzon de color gris',
        './imagenes/prod/calzon1.jpg',
        2,
        6,
        1
    ),
    (
        99.99,
        'CALZON 2',
        'calzon de color gris',
        './imagenes/prod/calzon2.jpg',
        2,
        6,
        1
    ),
    (
        99.99,
        'CALZON 3',
        'calzon de color gris',
        './imagenes/prod/calzon3.jpg',
        2,
        6,
        1
    ),
    -- Asignado a la categoría 'calzoncillos' (ID 6)
    (
        99.99,
        'CALCETIN 1',
        'calcetin de color gris',
        './imagenes/prod/calcetin1.jpg',
        2,
        7,
        1
    ),
    (
        99.99,
        'CALCETIN 2',
        'calcetin de color gris',
        './imagenes/prod/calcetin2.jpg',
        2,
        7,
        1
    ),
    (
        99.99,
        'CALCETIN 3',
        'calcetin de color gris',
        './imagenes/prod/calcetin3.jpg',
        2,
        7,
        1
    ),
    -- Asignado a la categoría 'calcetines' (ID 7)
    (
        99.99,
        'ZAPATILLA 1',
        'zapatillas de color gris',
        './imagenes/prod/zapa1.jpg',
        2,
        8,
        1
    ),
    (
        99.99,
        'ZAPATILLA 2',
        'zapatillas de color gris',
        './imagenes/prod/zapa2.jpg',
        2,
        8,
        1
    ),
    (
        99.99,
        'ZAPATILLA 3',
        'zapatillas de color gris',
        './imagenes/prod/zapa3.jpg',
        2,
        8,
        1
    ),
    -- Asignado a la categoría 'zapatillas' (ID 8)
;