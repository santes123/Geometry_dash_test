
var div_mensajes = document.getElementById("mensajes");
var tooltip_mensaje = document.getElementById("tooltiptext");
//enviar mensaje con boton tambn
function enviarMensaje (mensaje) {
	//alert("has enviado un mensaje!");
	if(mensaje == ""){
		//alert("escribe un mensaje!");
		//mostramos el tooltip de aviso
		tooltip_mensaje.style.visibility = 'visible';
		tooltip_mensaje.style.opacity = "1";
		//ponemos el foco en el input
		input_mensaje.focus();
	}else{
		//ocultamos el tooltip de aviso
		tooltip_mensaje.style.visibility = 'invisible';
		tooltip_mensaje.style.opacity = "0";

		//calculamos la hora para añadirla junto al usuario
		var fecha = new Date();
		var hora = fecha.getHours()+":"+fecha.getMinutes();

		var nuevo_div = document.createElement("div");
		nuevo_div.id = "div";
		nuevo_div.style.display = 'flex';
		nuevo_div.style.border = '0px solid black';
		nuevo_div.style.borderRadius = '10px';
		
		var parrafo_usuario = document.createElement("p");
		parrafo_usuario.id = "usuario";
		parrafo_usuario.innerHTML = hora+" - <u>"+localStorage.getItem("usuario")+"</u>";
		parrafo_usuario.style.width = '25%';
		parrafo_usuario.style.height = '25px';
		parrafo_usuario.style.margin = '0';
		parrafo_usuario.style.marginLeft = '5%';
		parrafo_usuario.style.paddingLeft = '1%';
		parrafo_usuario.style.marginTop = '2%';
		parrafo_usuario.style.marginBottom = '2%';
		parrafo_usuario.style.color = "blue";
		parrafo_usuario.style.backgroundColor = 'grey';
		parrafo_usuario.style.border = '0px solid black';
		parrafo_usuario.style.borderRadius = '10px';

		var parrafo_mensaje = document.createElement("p");
		parrafo_mensaje.id = "mensaje";
		parrafo_mensaje.innerHTML = mensaje;
		parrafo_mensaje.style.textAlign = 'justify';
		parrafo_mensaje.style.width = '70%';
		parrafo_mensaje.style.height = 'auto';
		parrafo_mensaje.style.backgroundColor = 'lightblue';
		parrafo_mensaje.style.margin = '0';
		parrafo_mensaje.style.marginLeft = '5%';
		parrafo_mensaje.style.marginTop = '2%';
		parrafo_mensaje.style.marginBottom = '2%';
		parrafo_mensaje.style.opacity = '0.7';
		parrafo_mensaje.style.padding = '5px';
		parrafo_mensaje.style.color = "red";
		parrafo_mensaje.style.border = '0px solid black';
		parrafo_mensaje.style.borderRadius = '10px';
		
		/*
		if(parrafo_mensaje.style.width >= document.getElementById("mensajes").style.width){
			//alert("demasiado grande");
			parrafo_mensaje.innerHTML = mensaje+"\n";
		}else{
			parrafo_mensaje.innerHTML = mensaje;
		}
		*/
		nuevo_div.appendChild(parrafo_usuario);
		nuevo_div.appendChild(parrafo_mensaje);
		div_mensajes.appendChild(nuevo_div);
		//div_mensajes.appendChild(parrafo_mensaje);

		//borramos el texto en el input de enviar mensaje
		window.document.getElementById("input_mensaje").value = "";

		//ponemos el foco en el input
		input_mensaje.focus();
	}
	
}
function conectarse_lista (usuario) {
	var lista_usuarios = document.getElementById("usuarios_online");
	lista_usuarios.style.overflowY = 'scroll';

	var nuevo_usuario = document.createElement("p");
	nuevo_usuario.className = "usuario_online";
	nuevo_usuario.style.width = '80%';
	nuevo_usuario.style.height = '5%';
	nuevo_usuario.style.color = 'green';
	nuevo_usuario.style.marginLeft = '10%';
	nuevo_usuario.style.fontSize = '12pt';
	nuevo_usuario.innerHTML = usuario;
	nuevo_usuario.onclick = function(){
		alert(usuario);
	};

	lista_usuarios.appendChild(nuevo_usuario);
}
function getEvent(event){
    var evento = window.event;

    if(evento.type == "keydown" && evento.keyCode == 13){
    	//al pulsar enter
    	//el mensaje escrito por el usuario
    	var mensaje_escrito = document.getElementById("input_mensaje").value;
    	//console.log(mensaje_escrito);
		//console.log(localStorage.getItem("usuario"));

    	enviarMensaje(mensaje_escrito);

    }
}

window.onload = function() { //acceso a los eventos.
document.onkeyup = getEvent;
document.onkeypress = getEvent;
document.onkeydown = getEvent;
entrar_chat();
}