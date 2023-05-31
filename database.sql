CREATE DATABASE IF NOT EXISTS laravel_master;

USE laravel_master;

CREATE TABLE IF NOT EXISTS USUARIO(
    id  int(255) auto_increment not null,
    role    varchar(20),
    name varchar(100),
    surname varchar(200),
    nick varchar(100),
    email varchar(255),
    password varchar(255),
    image varchar(255),
    created_at datetime,
    updated_at datetime,
    remember_at varchar(255),
    CONSTRAINT pk_users PRIMARY KEY(id)
)ENGINE=InnoDB;


CREATE TABLE IF NOT EXISTS IMAGEN(
    id int(255) auto_increment not null,
    user_id int(255),
    image_path varchar(255),
    descripcion text,
    created_at datetime,
    updated_at datetime,
    CONSTRAINT pk_image PRIMARY KEY(id),
    CONSTRAINT fk_image FOREIGN KEY(user_id) REFERENCES USUARIO(id)
)ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS COMENTARIO(
    id int (255) auto_increment not null,
    user_id int(255),
    image_id int(255),
    content text,
    created_at datetime,
    updated_at datetime,
    CONSTRAINT pk_comments PRIMARY KEY(id),
    CONSTRAINT fk_comments_user FOREIGN KEY(image_id) REFERENCES IMAGEN(id)
)ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS MEGUSTA(
    id int (255) auto_increment not null,
    user_id int(255),
    image_id int(255),
    created_at datetime,
    updated_at datetime,
    CONSTRAINT pk_like PRIMARY KEY(id),
    CONSTRAINT fk_like_image FOREIGN KEY(user_id) REFERENCES USUARIO(id),
    CONSTRAINT fk_like_user FOREIGN KEY(image_id) REFERENCES IMAGEN(id)
)ENGINE=InnoDB;

INSERT INTO USUARIO VALUES(NULL, 'user', 'Victor', 'Robles', 'comun', 'kevin@gmail.com', 'pass', NULL, CURTIME(), CURTIME(), NULL);
INSERT INTO USUARIO VALUES(NULL, 'user', 'Kevin', 'Gino', 'comun', 'kevin@gmail.com', 'pass', NULL, CURTIME(), CURTIME(), NULL);
INSERT INTO USUARIO VALUES(NULL, 'user', 'Carlos', 'Miguel', 'comun', 'carlos@gmail.com', 'pass', NULL, CURTIME(), CURTIME(), NULL);

INSERT INTO IMAGEN VALUES(NULL, 1, 'test.jpg', 'descripcion de prueba 1', CURTIME(), CURTIME());
INSERT INTO IMAGEN VALUES(NULL, 1, 'Playa.jpg', 'descripcion de prueba 2', CURTIME(), CURTIME());
INSERT INTO IMAGEN VALUES(NULL, 1, 'Arena.jpg', 'descripcion de prueba 3', CURTIME(), CURTIME());
INSERT INTO IMAGEN VALUES(NULL, 3, 'familia.jpg', 'descripcion de prueba 4', CURTIME(), CURTIME());

INSERT INTO COMENTARIO VALUES(NULL, 1, 4, 'Buena foto de familia', CURTIME(), CURTIME());
INSERT INTO COMENTARIO VALUES(NULL, 2, 1, 'Buena foto de PLAYA', CURTIME(), CURTIME());
INSERT INTO COMENTARIO VALUES(NULL, 2, 4, 'Que bueno', CURTIME(), CURTIME());

INSERT INTO MEGUSTA VALUES(NULL, 1, 4, CURTIME(), CURTIME());
INSERT INTO MEGUSTA VALUES(NULL, 2, 4, CURTIME(), CURTIME());
INSERT INTO MEGUSTA VALUES(NULL, 3, 1, CURTIME(), CURTIME());
INSERT INTO MEGUSTA VALUES(NULL, 3, 2, CURTIME(), CURTIME());
INSERT INTO MEGUSTA VALUES(NULL, 2, 1, CURTIME(), CURTIME());


SELECT * FROM IMAGEN;