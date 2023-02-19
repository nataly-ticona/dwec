
DROP TABLE users;

CREATE TABLE users (
    id int auto_increment primary key,
    nombre text,
    apellidos text,
    dni text unique,
    estudios text
)