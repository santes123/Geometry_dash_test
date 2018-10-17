drop database if exists geometryDash;
create database if not exists geometryDash DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
use geometryDash;
#tabla usuarios
drop table if exists usuario;
create table if not exists usuario(
idUsuario int not null auto_increment,
usuario varchar(50) not null unique,
contrasenha varchar(50) not null,
CONSTRAINT PK_Usuario primary key(idUsuario)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
#tabla datos de cada usuario
drop table if exists datos_usuario;
create table if not exists datos_usuario(
id int not null auto_increment,
nombre varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci not null,
apellidos varchar(80) CHARACTER SET utf8 COLLATE utf8_general_ci not null,
email varchar(100) not null unique,
usuario varchar(50) not null unique,
contrasenha varchar(50) not null,
CONSTRAINT PK_Usuario primary key(id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
#tabla puntuaciones de todos
drop table if exists puntuaciones;
create table if not exists puntuaciones(
id int not null auto_increment,
puntuacion int not null,
nivel enum('1','2','3','4'),
user_id int not null,
CONSTRAINT PK_Puntuaciones primary key(id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
#tabla de ruta imagenes- perfil usuarios
drop table if exists img_usuario_servidor;
create table if not exists img_usuario_servidor(
idUsuario int not null,
src varchar(150) not null,
constraint PK_img_usuario_ruta primary key(idUsuario)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

#categorias(salas) del chat online
drop table if exists categorias_chat;
create table if not exists categorias_chat(
id int not null auto_increment,
categoria varchar(100) not null,
constraint PK_categorias_chat primary key(id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
#discusiones em la pagina principal de Foro
drop table if exists discusiones;
create table if not exists discusiones(
id int not null auto_increment,
nombre_discusion varchar(150) not null unique,
constraint PK_discusiones primary key(id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
#contenido incluidos en esa discusion
drop table if exists entradas_discusiones;
create table if not exists entradas_discusiones(
id int not null auto_increment,
titulo_entrada varchar(100) not null,
texto varchar(300) not null,
idUsuario int not null,
idDiscusion int not null,
constraint PK_entradas_discusiones primary key(id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

#tabla de comentarios sobre los posts del foro
drop table if exists comentarios_entradas_foro;
create table if not exists comentarios_entradas_foro(
id int not null auto_increment,
idUsuario int not null,
comentario varchar(200),
idDiscusion int not null,
constraint PK_comentarios_entradas_foro primary key(id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

#tabla de logros generales de la pagina
#ACABAR ESTA TABLA
drop table if exists logros_generales;
create table if not exists logros_generales(
id int not null auto_increment,
nombre_logro varchar(150) not null,
dia_conseguido date not null,
idUsuario int not null,
constraint PK_logros_generales primary key(id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

#tabla de logros generales de la pagina
#ACABAR ESTA TABLA
drop table if exists logros_juegos;
create table if not exists logros_juegos(
id int not null auto_increment,
nombre_logro varchar(150) not null,
dia_conseguido date not null,
idUsuario int not null,
juego varchar(100) not null,
constraint PK_logros_juegos primary key(id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

#tabla con la lista de todos los logros. Los 2 booleanos son para saber a que 
#tabla pertecenen, con valor de 0 o 1, 0 es false y 1 es true
drop table if exists logros;
create table if not exists logros(
id int not null auto_increment,
nombre_logro varchar(150) not null,
logros_generales bool not null,
logros_juegos bool not null,
constraint PK_logros primary key(id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

#tabla que continie las variables a tener en cuenta dentro de Geometry Dash
drop table if exists variables_geometry_dash;
create table if not exists variables_geometry_dash(
id int not null auto_increment,
nombre_variable varchar(100) not null,
constraint PK_logros primary key(id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

#tabla que continie las variables a tener en cuenta dentro de Geometry Dash para cada usuario
drop table if exists variables_geometry_dash_usuarios;
create table if not exists variables_geometry_dash_usuarios(
id int not null auto_increment,
idVariable int not null,
valor varchar(100) not null,
idUsuario int not null,
constraint PK_logros primary key(id)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;


#añadimos una foreign key a kla tabla usuario para que tenga que coincidir con la tabla datos_usuario
ALTER TABLE usuario ADD CONSTRAINT usuario_datosUsuario_FK FOREIGN KEY (idUsuario)
REFERENCES datos_usuario (id) ON DELETE CASCADE ON UPDATE CASCADE;

#añadimos al foreign key de la tabla usuarios a puntuaciones
ALTER TABLE puntuaciones ADD CONSTRAINT Puntuaciones_usuario_FK FOREIGN KEY (user_id)
REFERENCES usuario (idUsuario) ON DELETE CASCADE ON UPDATE CASCADE;

#alteramos la tabla img_usuario_servidor para apadirle la foreign key de la tabla usuario(idUsuario)
alter table img_usuario_servidor add constraint usuario_imgUsuario_FK foreign key (idUsuario)
references usuario (idUsuario) on delete cascade on update cascade;

#alteramos al tabla datos_cliente para añadir algunos campos "no obligatorios" 
#que podras rellenar en tu perfil.
alter table datos_usuario add column telefono int(15) after contrasenha;
alter table datos_usuario add column direccion varchar(100) after telefono;
alter table datos_usuario add column biografia varchar(400) after direccion;

#alteramos la tabla entradas_discusiones para añadir las foreign keys de usuario y discusion
ALTER TABLE entradas_discusiones ADD CONSTRAINT idUsuarioEntradas_idUsuarioUsuarios_FK 
FOREIGN KEY (idUsuario) REFERENCES usuario (idUsuario) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE entradas_discusiones ADD CONSTRAINT idDiscusion_idDiscusiones_FK 
FOREIGN KEY (idDiscusion) REFERENCES discusiones (id) ON DELETE CASCADE ON UPDATE CASCADE;

#alteramos la tabla comentarios_entradas_foro para añadir las foreign keys de usuario y discusion
ALTER TABLE comentarios_entradas_foro ADD CONSTRAINT idUsuarioComentario_idUsuarioUsuarios_FK 
FOREIGN KEY (idUsuario) REFERENCES usuario (idUsuario) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE comentarios_entradas_foro ADD CONSTRAINT idDiscusionComentario_idDiscusiones_FK 
FOREIGN KEY (idDiscusion) REFERENCES discusiones (id) ON DELETE CASCADE ON UPDATE CASCADE;

alter table comentarios_entradas_foro add column idEntrada int not null;

ALTER TABLE comentarios_entradas_foro ADD CONSTRAINT idEntradaComentario_idEntrada_FK 
FOREIGN KEY (idEntrada) REFERENCES entradas_discusiones (id) ON DELETE CASCADE ON UPDATE 
CASCADE;

#si en algun momento hay que resetear el auto_increment usamos esto
#alter table entradas_discusiones AUTO_INCREMENT = 3;
#alter table comentarios_entradas_foro AUTO_INCREMENT = 2;

#añadimos las foreign keys a las tablas de logros
ALTER TABLE logros_juegos ADD CONSTRAINT id_usuario_logros_juegos_idUsuario_FK 
FOREIGN KEY (idUsuario) REFERENCES usuario (idUsuario) ON DELETE CASCADE ON 
UPDATE CASCADE;

ALTER TABLE logros_generales ADD CONSTRAINT id_usuario_logros_generales_idUsuario_FK 
FOREIGN KEY (idUsuario) REFERENCES usuario (idUsuario) ON DELETE CASCADE ON 
UPDATE CASCADE;

#añadimos las foreign keys a la tabla variables_geometry_dash_usuarios
ALTER TABLE variables_geometry_dash_usuarios ADD CONSTRAINT id_usuario_variables_geometryDash_idUsuario_FK 
FOREIGN KEY (idUsuario) REFERENCES usuario (idUsuario) ON DELETE CASCADE ON 
UPDATE CASCADE;

ALTER TABLE variables_geometry_dash_usuarios ADD CONSTRAINT id_variable_geometryDash_idVariable_FK 
FOREIGN KEY (idVariable) REFERENCES variables_geometry_dash (id) ON DELETE CASCADE ON 
UPDATE CASCADE;






