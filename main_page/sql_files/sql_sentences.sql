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




