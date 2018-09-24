# 10 mejores puntuaciones actuales
select user_id,nivel,puntuacion from puntuaciones order by puntuacion asc limit 10;

# Tus 3 mejores puntuaciones
select user_id,nivel,puntuacion from puntuaciones as p join usuario as u on(p.user_id = idUsuario)
where usuario="santes123" order by puntuacion asc limit 3;

