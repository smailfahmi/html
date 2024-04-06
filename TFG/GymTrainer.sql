CREATE DATABASE gymtrainer;
DROP USER IF EXISTS gymtrainer;
CREATE USER gymtrainer IDENTIFIED BY 'gymtrainer';
GRANT ALL ON gymtrainer.* TO gymtrainer;
-- Tabla de usuarios
CREATE TABLE usuarios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    usuario VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL,
    nombre VARCHAR(50) NOT NULL,
    apellidos VARCHAR(50) NOT NULL,
    telefono VARCHAR(20),
    altura DECIMAL(5,2),
    sexo VARCHAR(10),
    fechaNacimiento DATE,
    tipoUsuario VARCHAR(20)
);

-- Tabla de datosDelUsuario
CREATE TABLE datosUsuario (
    id INT PRIMARY KEY AUTO_INCREMENT,
    peso DECIMAL(5,2),
    circunferenciaCuello DECIMAL(5,2),
    circunferenciaAbdominal DECIMAL(5,2),
    niveActividadDiaria DECIMAL(5,2),
    fechaRegistro DATE,
    objetivo VARCHAR(100),
    idUsuarioFK INT,
    FOREIGN KEY (idUsuarioFK) REFERENCES usuarios(id)
);

-- Tabla de rutina
CREATE TABLE rutina (
    id INT PRIMARY KEY AUTO_INCREMENT,
    tipoRutina VARCHAR(50),
    fechaInicio DATE,
    idUsuarioFK INT,
    fechaFin DATE,
    FOREIGN KEY (idUsuarioFK) REFERENCES usuarios(id)
);

-- Tabla de ejercicios
CREATE TABLE ejercicios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nombreEjercicio VARCHAR(100),
    descripcionEjercicio TEXT,
    grupoMuscular VARCHAR(50),
    dificultad VARCHAR(20),
    enlace VARCHAR(255)
);

-- Tabla de detalleRutina
CREATE TABLE detalleRutina (
    id INT PRIMARY KEY AUTO_INCREMENT,
    idRutinaFK INT,
    idEjercicioFK INT,
    repeticiones INT,
    repeticionesLogradas INT,
    diaDeSemana VARCHAR(10),
    FOREIGN KEY (idRutinaFK) REFERENCES rutina(id),
    FOREIGN KEY (idEjercicioFK) REFERENCES ejercicios(id)
);

-- Insertar datos en la tabla usuarios
INSERT INTO usuarios (usuario, password, nombre, apellidos, telefono, altura, sexo, fechaNacimiento, tipoUsuario) VALUES
('usuario1', 'contraseña1', 'Juan', 'Pérez', '123456789', 1.75, 'Masculino', '1990-05-15', 'Normal'),
('usuario2', 'contraseña2', 'María', 'López', '987654321', 1.65, 'Femenino', '1995-09-20', 'Premium'),
('usuario3', 'contraseña3', 'Carlos', 'González', '456123789', 1.80, 'Masculino', '1985-07-10', 'Normal');

-- Insertar datos en la tabla datosDelUsuario
INSERT INTO datosDelUsuario (peso, circunferenciaCuello, circunferenciaAbdominal, niveActividadDiaria, fechaRegistro, objetivo, idUsuarioFK) VALUES
(70.5, 40.0, 85.0, 1.5, '2024-03-27', 'Perder peso', 1),
(65.0, 38.0, 80.0, 1.3, '2024-03-27','Ganar masa muscular', 2),
(80.0, 42.0, 90.0, 1.2,'2024-03-27', 'Mantenerme en forma', 3),

-- Insertar ejercicios en la tabla ejercicios
INSERT INTO ejercicios (nombreEjercicio, descripcionEjercicio, grupoMuscular, dificultad, enlace) VALUES
-- Pecho
('Press de banca', 'Ejercicio para fortalecer los músculos del pecho.', 'Pecho', 'Intermedio', 'https://www.youtube.com/watch?v=ICaZxO7RmKs'),
('Aperturas con mancuernas', 'Ejercicio para trabajar los músculos pectorales.', 'Pecho', 'Intermedio', 'https://www.youtube.com/watch?v=xyHdY99F640'),
('Flexiones de brazos', 'Ejercicio para fortalecer los músculos del pecho, hombros y tríceps.', 'Pecho', 'Intermedio', 'https://www.youtube.com/watch?v=2ZSq1BRYwAI'),
('Fondos en paralelas', 'Ejercicio para trabajar los músculos del pecho y los tríceps.', 'Pecho', 'Avanzado', 'https://www.youtube.com/watch?v=DcS44T6Y5GQ'),
('Cruce de polea', 'El cruce de polea es un ejercicio de aislamiento que trabaja los músculos pectorales. Se realiza con una máquina de poleas y es excelente para trabajar la parte interna del pecho.', 'Pecho', 'Intermedio', 'https://www.youtube.com/watch?v=XnaMi2Gb_9Q'),
('Peck Deck', 'El Peck Deck es un ejercicio de aislamiento que se realiza en una máquina específica. Es ideal para trabajar los pectorales medios y externos.', 'Pecho', 'Intermedio', 'https://www.youtube.com/watch?v=Akr-wughO_0'),
('Press de mancuernas banco inclinado', 'El press de mancuernas en banco inclinado es un ejercicio compuesto que se realiza en un banco inclinado. Trabaja principalmente los pectorales superiores y los hombros.', 'Pecho', 'Intermedio', 'https://www.youtube.com/watch?v=sNXrm1GjfH8'),
('Press mancuernas', 'El press de mancuernas es un ejercicio clásico para desarrollar los pectorales. Se puede realizar en banco plano, inclinado o declinado, dependiendo de la parte del pecho que se desee trabajar.', 'Pecho', 'Intermedio', 'https://www.youtube.com/watch?v=5wN-99Fny5Q'),
('Press en multipower', 'El press en multipower es una variante del press de banca que se realiza en una máquina multipower. Es útil para mantener la estabilidad y controlar el movimiento.', 'Pecho', 'Intermedio', 'https://www.youtube.com/watch?v=2zXqt08top8'),
('Cruce de poleas barra baja', 'El cruce de poleas con barra baja es otro ejercicio de aislamiento que se enfoca en los pectorales. Se realiza con una máquina de poleas y es excelente para trabajar la parte baja del pecho.', 'Pecho', 'Intermedio', 'https://www.youtube.com/watch?v=JNVGQZm7dQU'),
-- Espalda
('Dominadas', 'Ejercicio para trabajar la espalda.', 'Espalda', 'Intermedio', 'https://www.youtube.com/watch?v=BT8ikvivBYc'),
('Remo con barra', 'Ejercicio para fortalecer la espalda baja y los músculos de la espalda.', 'Espalda', 'Intermedio', 'https://www.youtube.com/watch?v=Qod0cqcdxM4'),
('Pull-ups con agarre ancho', 'Ejercicio para fortalecer la parte superior de la espalda.', 'Espalda', 'Avanzado', 'https://www.youtube.com/watch?v=LJJrzrHtVPM'),
('Remo Gironda', 'El remo Gironda es un ejercicio que enfatiza el desarrollo de la espalda baja y media. Se realiza con una barra en una posición inclinada y permite un rango de movimiento amplio.', 'Espalda', 'Intermedio', 'https://www.youtube.com/watch?v=K-7X8-9MRnQ'),
('Peso Muerto Rumano', 'El peso muerto rumano es un ejercicio excelente para trabajar los músculos de la espalda, así como los isquiotibiales y los glúteos. Se realiza con una barra y enfatiza el movimiento de la cadera.', 'Espalda', 'Intermedio', 'https://www.youtube.com/watch?v=g137Wyypu-w'),
('Remo con Mancuerna', 'El remo con mancuerna es un ejercicio que se centra en los músculos de la espalda y los brazos. Se puede realizar de pie o con un banco para mayor estabilidad.', 'Espalda', 'Intermedio', 'https://www.youtube.com/watch?v=EiGN5ohOYOc'),
('Pullover', 'El pullover es un ejercicio clásico que trabaja los músculos de la espalda, el pecho y los tríceps. Se puede realizar con una mancuerna o una barra y se enfoca en la extensión de los brazos por encima de la cabeza.', 'Espalda', 'Intermedio', 'https://www.youtube.com/watch?v=NfCTdUmWYx0'),
('Remo con Barra', 'El remo con barra es un ejercicio compuesto que trabaja los músculos de la espalda, los hombros y los brazos. Se realiza levantando una barra desde el suelo hasta el torso.', 'Espalda', 'Intermedio', 'https://www.youtube.com/watch?v=Qod0cqcdxM4&t=1s'),
('Remo Barra T', 'El remo con barra T es un ejercicio que se enfoca en los músculos de la espalda baja y media, así como los deltoides posteriores. Se realiza con una barra y un banco inclinado.', 'Espalda', 'Intermedio', 'https://www.youtube.com/watch?v=ICRHNN0Lxac'),
('Pull-ups con agarre estrecho', 'Variación de pull-ups para enfocarse más en los músculos de los brazos.', 'Espalda', 'Avanzado', 'https://ejemplo.com/video14'),
-- Piernas
('Sentadillas', 'Ejercicio compuesto que involucra muchos grupos musculares, incluidos los cuádriceps, los glúteos, los isquiotibiales y los músculos de la espalda baja.', 'Piernas', 'Avanzado', 'https://www.youtube.com/watch?v=qsAkuNORgmk'),
('Prensa de piernas Gluteo', 'Ejercicio para fortalecer los cuádriceps y los glúteos.', 'Piernas', 'Intermedio', 'https://www.youtube.com/watch?v=h6vVZZiBe7w'),
('Prensa de piernas', 'La prensa de piernas es un ejercicio excelente para trabajar los cuádriceps y los glúteos. Se realiza en una máquina de prensa, lo que permite un movimiento controlado y seguro.', 'Piernas', 'Intermedio', 'https://www.youtube.com/watch?v=xvCynwyNoP4'),
('Zancadas', 'Las zancadas son un ejercicio efectivo para trabajar los músculos de las piernas, incluidos los cuádriceps, los glúteos y los isquiotibiales. Se pueden hacer con o sin peso adicional.', 'Piernas', 'Intermedio', 'https://www.youtube.com/watch?v=YX7733B17gY'),
('Elevación de talones', 'La elevación de talones es un ejercicio que se centra en los músculos de la pantorrilla. Se puede realizar con una máquina específica para talones o con mancuernas para aumentar la resistencia.', 'Piernas', 'Intermedio', 'https://www.youtube.com/watch?v=GUBzhO-XSqk');
('Extensión de cuádriceps', 'La extensión de cuádriceps es un ejercicio de aislamiento que se realiza en una máquina específica. Se centra en trabajar los músculos del cuádriceps.', 'Piernas', 'Intermedio', 'https://www.youtube.com/watch?v=UVvyNfw97og'),
('Curl femoral de pie', 'El curl femoral de pie es un ejercicio que se centra en trabajar los músculos isquiotibiales. Se realiza con una máquina específica o con una polea baja.', 'Piernas', 'Intermedio', 'https://www.youtube.com/watch?v=BQ0yJ1ukx9A'),
('Curl femoral sentado', 'El curl femoral sentado es una variación del curl femoral que se realiza en una máquina específica. Es efectivo para trabajar los músculos isquiotibiales.', 'Piernas', 'Intermedio', 'https://www.youtube.com/watch?v=Th_m1_3upXo'),
('Extensión de cuádriceps alternando', 'La extensión de cuádriceps alternando se realiza en una máquina específica y permite trabajar cada pierna de forma independiente. Es útil para corregir desequilibrios musculares.', 'Piernas', 'Intermedio', 'https://www.youtube.com/watch?v=2Hg2nb1lrHA'),
('Peso muerto convencional', 'El peso muerto convencional es un ejercicio compuesto que involucra varios grupos musculares, incluyendo la espalda baja, los glúteos y los isquiotibiales. Es excelente para desarrollar fuerza y masa muscular.', 'Piernas', 'Avanzado', 'https://www.youtube.com/watch?v=cfgsCh_kaew'),
('Abducción en máquina', 'La abducción en máquina es un ejercicio que se centra en trabajar los músculos abductores de la cadera, incluyendo el glúteo medio. Se realiza en una máquina específica.', 'Piernas', 'Intermedio', 'https://www.youtube.com/watch?v=EJagAciZDNI'),
('Aducción en máquina', 'La aducción en máquina es un ejercicio que se centra en trabajar los músculos aductores de la cadera. Se realiza en una máquina específica.', 'Piernas', 'Intermedio', 'https://www.youtube.com/watch?v=fItDiXXZyZo');
-- Hombros
('Press militar', 'Ejercicio para trabajar los hombros.', 'Hombros', 'Intermedio', 'https://www.youtube.com/watch?v=Wz8ifiRefB0'),
('Elevaciones laterales', 'Ejercicio para fortalecer los deltoides laterales.', 'Hombros', 'Intermedio', 'https://www.youtube.com/watch?v=nOAUECQEpHs'),
('Press de hombros con mancuernas', 'Variación del press de hombros utilizando mancuernas.', 'Hombros', 'Intermedio', 'https://www.youtube.com/watch?v=GELRUlUSxeI&t=3s'),
('Elevaciones frontales con mancuernas', 'Ejercicio para trabajar los deltoides frontales.', 'Hombros', 'Intermedio', 'https://www.youtube.com/watch?v=ALpjzo_BNCA'),
('Elevaciones laterales con polea', 'Las elevaciones laterales con polea son un excelente ejercicio para trabajar los deltoides laterales. Se realizan con una polea baja y permiten un movimiento controlado y constante.', 'Hombros', 'Intermedio', 'https://www.youtube.com/watch?v=XXjUMV2o884'),
('Remo al mentón', 'El remo al mentón es un ejercicio que se centra en trabajar los deltoides posteriores y los trapecios. Se realiza con una barra o mancuernas, llevando el peso hacia la parte superior del pecho.', 'Hombros', 'Intermedio', 'https://www.youtube.com/watch?v=loL670Yb7nU'),
('Pájaros en contractor', 'Los pájaros en contractor son un ejercicio efectivo para aislar y trabajar los deltoides posteriores. Se realiza en una máquina específica y permite un movimiento controlado.', 'Hombros', 'Intermedio', 'https://www.youtube.com/watch?v=MbGsPo4fYqQ'),
('Press militar en multipower', 'El press militar en multipower es una variación del press militar tradicional que se realiza en una máquina multipower. Es útil para trabajar los deltoides y otros músculos estabilizadores.', 'Hombros', 'Intermedio', 'https://www.youtube.com/watch?v=DWMJt_H_Afw'),
-- Core
('Plank', 'El plank es un ejercicio estático que fortalece los músculos abdominales, lumbares y de la espalda. Se realiza manteniendo una posición de plancha con el cuerpo recto y apoyado en los antebrazos y los dedos de los pies.', 'Core', 'Intermedio', 'https://www.youtube.com/watch?v=kL_NJAkCQBg'),
('Mountain climbers', 'Los mountain climbers son un ejercicio dinámico que trabaja los abdominales y los músculos estabilizadores del core. Se realiza en posición de plancha, llevando las rodillas hacia el pecho alternativamente.', 'Core', 'Intermedio', 'https://www.youtube.com/watch?v=ruQ4ZwncXBg'),
('Russian twists', 'Los Russian twists son un ejercicio que fortalece los oblicuos y los músculos abdominales. Se realiza sentado en el suelo con las piernas levantadas y girando el torso de lado a lado mientras se sostiene un peso o se tocan las manos en el suelo.', 'Core', 'Intermedio', 'https://www.youtube.com/watch?v=Tau0hsW8iR0'),
('Dead bug', 'El dead bug es un ejercicio que fortalece los abdominales y los músculos estabilizadores del core. Se realiza acostado en el suelo con las piernas dobladas y los brazos extendidos hacia arriba, alternando el movimiento de las piernas y los brazos de forma controlada.', 'Core', 'Intermedio', 'https://www.youtube.com/watch?v=mUMVASv0x7U'),
-- Brazos
('Curl de bíceps con barra', 'Ejercicio para fortalecer los músculos del bíceps.', 'Biceps', 'Intermedio', 'https://www.youtube.com/watch?v=b8nB33AAYJE'),
('Extensiones de tríceps en polea alta', 'Ejercicio para trabajar los tríceps.', 'Triceps', 'Intermedio', 'https://www.youtube.com/watch?v=dRkTreltpnc'),
('Curl de bíceps con mancuernas', 'Variación del curl de bíceps utilizando mancuernas.', 'Biceps', 'Intermedio', 'https://www.youtube.com/watch?v=uICWtGLd4-I'),
('Extensiones de tríceps con mancuerna', 'Ejercicio para aislar los músculos del tríceps utilizando una mancuerna.', 'Triceps', 'Intermedio', 'https://www.youtube.com/watch?v=fQ-KB40W3d8'),
('Curl con barra Z', 'El curl con barra Z es un ejercicio clásico para el desarrollo de los bíceps. Se realiza con una barra Z, manteniendo los codos fijos y flexionando los brazos para levantar el peso.', 'Biceps', 'Intermedio', 'https://www.youtube.com/watch?v=b8nB33AAYJE'),
('Curl predicador', 'El curl predicador se realiza en un banco predicador, lo que ayuda a aislar los bíceps y a mantener una buena forma durante el ejercicio.', 'Biceps', 'Intermedio', 'https://www.youtube.com/watch?v=ERtAmNchnFQ'),
('Curl con cuerda en máquina', 'El curl con cuerda en máquina es un ejercicio de aislamiento para los bíceps. Se realiza en una máquina de poleas, permitiendo un rango de movimiento suave y constante.', 'Biceps', 'Intermedio', 'https://www.youtube.com/watch?v=fx9VW2lDx_s'),
('Patada tríceps unilateral', 'La patada de tríceps unilateral se realiza con una mancuerna, enfocándose en un tríceps a la vez. Es un ejercicio efectivo para el desarrollo de los tríceps.', 'Triceps', 'Intermedio', 'https://www.youtube.com/watch?v=Ea9hhPs3sp8'),
('Patada tríceps trasnuca', 'La patada de tríceps trasnuca se realiza con una mancuerna o un peso, llevando el peso hacia arriba y detrás de la cabeza. Es ideal para trabajar la porción larga del tríceps.', 'Triceps', 'Intermedio', 'https://www.youtube.com/watch?v=m-pFQ3zq_zQ'),
('Press cerrado', 'El press cerrado es un ejercicio compuesto que se realiza en una barra o en una máquina específica. Es excelente para trabajar los tríceps, especialmente la porción larga.', 'Triceps', 'Intermedio', 'https://www.youtube.com/watch?v=SF0uoT4JWNw');

-- Detalles de la rutina
INSERT INTO rutina (tipoRutina, fechaInicio, idUsuarioFK) VALUES
('Rutina de fuerza', '2024-03-28', 1); -- Suponiendo que el usuario tiene el ID 1

-- Día 1: Pecho y Tríceps
INSERT INTO detalleRutina (idRutinaFK, idEjercicioFK, repeticiones,diaDeSemana) VALUES
(1, 0, 12,'LUNES'), -- Press de banca
(1, 1, 10,'LUNES'), -- Aperturas con mancuernas
(1, 58, 12,'LUNES'), -- Press cerrado
(1, 3, 10,'LUNES'), -- Fondos en paralelas
(1, 56, 12,'LUNES'), -- Patada tríceps unilateral
(1, 5, 10,'LUNES'); -- Peck deck

-- Día 2: Espalda y Bíceps
INSERT INTO detalleRutina (idRutinaFK, idEjercicioFK, repeticiones,diaDeSemana) VALUES
(1, 11, 12,'MARTES'), -- Dominadas
(1, 12, 10,'MARTES'), -- Remo con barra
(1, 53, 12,'MARTES'), -- Curl con barra Z
(1, 54, 10,'MARTES'), -- Curl predicador
(1, 40, 12,'MARTES'), -- Remo al mentón
(1, 55, 10,'MARTES'); -- Curl con cuerda en máquina

-- Día 3: Piernas y Hombros
INSERT INTO detalleRutina (idRutinaFK, idEjercicioFK, repeticiones,diaDeSemana) VALUES
(1, 12, 12,'MIERCOLES'), -- Sentadillas
(1, 24, 10,'MIERCOLES'), -- Prensa de piernas
(1, 37, 12,'MIERCOLES'), -- Press de hombros con mancuernas
(1, 39, 10,'MIERCOLES'), -- Elevaciones laterales con polea
(1, 27, 12,'MIERCOLES'), -- Extensiones de cuádriceps
(1, 28, 10,'MIERCOLES'); -- Curl femoral de pie

-- Día 4: Core y Cardio
INSERT INTO detalleRutina (idRutinaFK, idEjercicioFK, repeticiones,diaDeSemana) VALUES
(1, 44, 20,'JUEVES'), -- Plank
(1, 45, 30,'JUEVES'), -- Mountain climbers
(1, 46, 20,'JUEVES'), -- Russian twists
(1, 127, 20,'JUEVES'), -- Dead bug
