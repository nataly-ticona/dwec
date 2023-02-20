DROP TABLE IF EXISTS usuarios;
CREATE TABLE usuarios (
    id              int auto_increment PRIMARY KEY,
    nombre          VARCHAR(255) NOT NULL,
    apellidos       VARCHAR(255) NOT NULL,
    dni             VARCHAR(255) NOT NULL UNIQUE,
    estudios        VARCHAR(255) NOT NULL
);
