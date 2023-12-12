
    DROP DATABASE IF EXISTS trabajos;
    CREATE DATABASE trabajos;
    DROP USER IF EXISTS trabajos;
    CREATE USER trabajos IDENTIFIED BY 'SmailSmail';
    GRANT ALL ON trabajos.* TO trabajos;
    USE trabajos;
    CREATE TABLE MisTrabajos (
        id INT AUTO_INCREMENT PRIMARY KEY,
        empresa VARCHAR(50),
        meses DECIMAL(10, 2),
        fecha_entrada date  -- Cambio el tipo de datos a VARCHAR
    );
    INSERT INTO MisTrabajos (empresa, meses, fecha_entrada) 
    VALUES 
    ('Cobadu', 5.5, '2023-01-15'),
    ('Tellepiza', 8.2, '2022-09-30'),
    ('Coviran', 3.7, '2023-03-22');
