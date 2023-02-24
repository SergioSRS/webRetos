
--script categorias
CREATE TABLE categoria (
    idCategoria tinyint UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
    nombreCategoria varchar(100) unique NOT NULL 
); 
insert into categoria (nombreCategoria) values ("Ciencias Naturales");
insert into categoria (nombreCategoria) values ("Ciencias Sociales");
insert into categoria (nombreCategoria) values ("Musica");
insert into categoria (nombreCategoria) values ("Matematicas");
insert into categoria (nombreCategoria) values ("Tecnología");
--script profesores
create table profesores (

	id smallint unsigned auto_increment not null primary key,
	nombre varchar(100) not null,
	correo varchar(100) not null,
	password varchar(255) not null
);
CREATE unique INDEX claveCorreo
ON profesores (correo); 
insert into profesores (nombre,correo,password) values ("Sergio", "sergio@gmail.com", "1234");
insert into profesores (nombre,correo,password) values ("Raul", "raul@gmail.com", "1234");
insert into profesores (nombre,correo,password) values ("Laura", "laura@gmail.com", "1234");
insert into profesores (nombre,correo,password) values ("David", "david@gmail.com", "1234");
insert into profesores (nombre,correo,password) values ("Isa", "isa@gmail.com", "1234");

--script retos
CREATE TABLE retos(
	id SMALLINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nombre VARCHAR(100) unique NOT NULL,
	dirigido VARCHAR(100) NOT NULL,
	descripcion VARCHAR(100) NULL,
	fechaFinInscripcion DATETIME NOT NULL,
	fechaInicioInscripcion DATETIME NOT NULL CHECK ((fechaInicioInscripcion < fechaFinInscripcion OR fechaInicioInscripcion = fechaFinInscripcion)),
	fechaFinReto DATETIME NOT NULL,
	fechaInicioReto DATETIME NOT NULL CHECK ((fechaInicioInscripcion < fechaFinInscripcion OR fechaInicioInscripcion = fechaFinInscripcion)),
	fechaPublicacion DATETIME NOT NULL,
	publicado BIT NOT NULL ,
	idProfesor SMALLINT UNSIGNED NOT NULL,
	idCategoria TINYINT UNSIGNED NOT NULL,
	CONSTRAINT FK_idCategoria FOREIGN KEY (idCategoria) REFERENCES categoria (idCategoria),
	CONSTRAINT FK_idProfesor FOREIGN KEY (idProfesor) REFERENCES profesores (id)); 