use geometrydash;

#insert tabla categorias_chat
insert into categorias_chat (categoria) values('General'),('Juegos'),('Privada');

#insert tabla datos_usuarios -> la contraseña esta codificada en md5() ,sin md5 es 1234
insert into datos_usuarios (nombre,apellidos,email,usuario,contrasenha) 
values('nombre','apellido1 apellido2','ejemplo@gmail.com','usuario',
'81dc9bdb52d04dc20036dbd8313ed055');

#insert tabla discusiones
insert into discusiones (nombre_discusion) 
values('General'),('Juegos'),('Feedback'),('Problemas'),('Ayuda');

#insert tabla entradas_discusiones
insert into entradas_discusiones (titulo_entrada,texto,idUsuario,idDiscusion) 
values('1', 'Buenas a todos', 'Aquí podéis crear cualquier tipo de discusión 
sobre el tema que queráis para que el resto os respondan. Al ser general, a 
no ser faltas de respeto y demás no hay problema :).', '1', '1'
),
('2', 'Buenos dias Gamers', 'Pues aquí estamos de nuevo pro players, 
lets go', '1', '2'
),('3', 'Buenas a todos', 'Cualquier cosa que veáis que podemos mejorar 
dentro de la página nos la comunicáis aquí por favor. \r\n\r\nUn saludo a todos.', '1', '3'
),('4', 'Buenos días', 'Cualquier problema que tengáis en vuestra navegación de 
carácter grave para vosotros o el resto de usuarios decidnoslo por aquí y responderemos 
al instante.	', '1', '4'
),('5', 'Buenos días a todos', 'saludos jugadores, cualquier duda sobe algo en 
la pagina nos la comunicáis aquí. Un saludo a todos y pasáoslo bien.', '1', '5'
);

#insert tabla img_usuario_servidor
insert into img_usuario_servidor (idUsuario,src) 
values('1', 'img_silueta.jpg');

#insert tabla logros
insert into logros (nombre_logro,logros_generales,logros_juegos) 
values('1', 'registro completado!', '1', '0'
),('2', 'primer login completado!', '1', '0'),
('3', 'jugar GD por primera vez!', '0', '1'),
('4', 'cambia tu foto de perfil!', '1', '0'),
('5', '30 saltos en GD!', '0', '1');

#insert tabla usuario -> la contraseña esta codificada en md5() ,sin md5 es 1234
insert into usuario (idUsuario,usuario,contrasenha) 
values('1', 'usuario', '81dc9bdb52d04dc20036dbd8313ed055');

#insert tabla variables_geometry_dash
insert into variables_geometry_dash (nombre_variable) 
values('1', 'saltos');