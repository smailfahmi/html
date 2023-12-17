CREATE TABLE MisTrabajos (
    id SERIAL PRIMARY KEY,
    empresa VARCHAR(50),
    meses NUMERIC(10, 2),
    fecha_entrada DATE
);

INSERT INTO
    MisTrabajos (empresa, meses, fecha_entrada)
VALUES
    ('Cobadu', 5.5, '2023-01-15'),
    ('Tellepiza', 8.2, '2022-09-30'),
    ('MC', 3.7, '2023-03-22');