#alteramos el auto_increment de la tabla puntuaciones y lo reiniciamos
ALTER TABLE puntuaciones AUTO_INCREMENT = 1;

# 10 mejores puntuaciones actuales
# Por ID
select user_id,nivel,puntuacion from puntuaciones order by puntuacion asc limit 10;
# Por Usuario
select puntuacion,nivel,u.usuario from puntuaciones as p join usuario as u on(p.user_id=u.idUsuario)
order by puntuacion desc limit 10;

# Tus 10 mejores puntuaciones
select user_id,nivel,puntuacion from puntuaciones as p join usuario as u on(p.user_id = idUsuario)
where usuario="santes123" order by puntuacion asc limit 10;

#insert en la tabla img_usuario_servidor de la imagen de cada usuario (se pone una basica,
#y se actualizara en la pagina "editar_perfil" ,subiendo una imagen al servidor y seleccionandola
insert into img_usuario_servidor (idUsuario,src) values(1,'img_silueta.jpg');


#recuperar el src de la imagen de perfil
select ius.idUsuario,src from img_usuario_servidor as ius join usuario as u on(ius.idUsuario=u.idUsuario)
where usuario = "santes123";

#updatear el src de la imagen dr perfil
UPDATE img_usuario_servidor SET src = 'img_silueta.jpg' WHERE idUsuario = 1;

#insertamos categorias de chat -> privada con contraseña añadiremos
insert into categorias_chat (categoria) values('General'),('Juegos'),('Privada');

#insertamos datos en la tabla discusiones para añadir 2 o 3 basicas,mas tarde los usuarios podran 
#añadir discusiones

insert into discusiones (id,nombre_discusion) values(1,'general'),(2,'juegos'),(3,'feedback'),
(4,'problemas'),(5,'ayuda');

#insertamos un post en el foro general para ver como se veria
insert into entradas_discusiones (titulo_entrada,texto,idUsuario,idDiscusion) values('Ejemplo post','Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',1,1);

#seleccionamos el nombre del usuario segun su id
select idUsuario,usuario from usuario where idUsuario= 1;

#insertamos datos en la tabla de comentarios
insert into comentarios_entradas_foro (idUsuario,comentario,idDiscusion,idEntrada) 
values(idUsuario,'',idDiscusion,idEntrada);

#seleccionamos los comentarios de un post
select id,idUsuario,comentario,idDiscusion,idEntrada from comentarios_entradas_foro 
where idEntrada = "" order by id asc;

#devuelve todos los comentario de una entrada
select id,comentario from comentarios_entradas_foro as cef where idEntrada = 1;

#devuelve el usuario que ha escrito el post comentario X
select usuario from usuario as u join comentarios_entradas_foro as cef 
on(u.idUsuario=cef.idUsuario) where cef.id = '1';

#borramos un comentario por su id
delete from comentarios_entradas_foro where id = 1;

#insertamos un par de logros en la tabla de logros
insert into logros (nombre_logro, logros_generales, logros_juegos) 
values 
('registro completado!',1,0),
('primer login completado!',1,0),
('jugar GD por primera vez!',0,1),
('cambia tu foto de perfil!',1,0),
('30 saltos en GD!',0,1);

#recuperamos el logro de un usuario para saber si lo tiene ya o no
select * from logros_generales where idUsuario = '6' and nombre_logro = 
'registro completado!';

#insertamos al registrarse una imagen por defecto dentro del servidor
insert into img_usuario_servidor (idUsuario,src) 
values(1,"proyect.local/paginas/Perfil/img_perfil/img_silueta.jpg");

#insertamos logros y actualizamos algunos en un usuario para visualizarlos en logros
insert into logros_generales (nombre_logro,dia_conseguido,idUsuario) 
values ('registro completado!','2018/10/12',1),
		('jugar GD por primera vez!','2018/10/14',1),
        ('cambia tu foto de perfil!','2018/10/13',1);
        
update logros_generales set dia_conseguido  = '2018/10/12' 
where nombre_logro='primer login completado!' and idUsuario = 1;

#seleccionamos si el usuario actual tiene el logro
select nombre_logro from logros_generales as lg join usuario as u 
on(lg.idUsuario=u.idUsuario) where usuario = 'santes123' and 
nombre_logro = 'cambia tu foto de perfil!';

#verificamos si el usuario tiene el logro de jugar al GD por 1º vez
select nombre_logro,lg.idUsuario from logros_juegos as lg join usuario as u on(lg.idUsuario=u.idUsuario)
 where usuario = 'santes123';

#insertamos los saltos en la tabla de variables
insert into variables_geometry_dash (nombre_variable) values('saltos');

#insertamos los saltos de un jugador en la tabla de variables de jugadores
insert into variables_geometry_dash_usuarios (idVariable,valor,idUsuario) values(1,'5',1);

#actualizamos la variable saltos del usuario
update variables_geometry_dash_usuarios set valor = valor + 5 where idVariable = '1' 
and idUsuario = '1';

#verificamos si el usuario ha superado el logro de 30 saltos(mirando en su variable de juego)
select usuario,valor from variables_geometry_dash_usuarios as vgdu join usuario as u 
on(vgdu.idUsuario = u.idUsuario) where usuario = 'santes123' and valor >= 30;

#verificamos si el usuario ya tiene el logro
select nombre_logro from logros_juegos as lg join usuario as u on(lg.idUsuario=u.idUsuario)
where usuario = 'santiyo123' and nombre_logro = '30 saltos en GD!';

#











