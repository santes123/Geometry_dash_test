
var canvas = document.getElementById("canvas");
var context = canvas.getContext("2d");
//variables fijas
var FPS = 50;
var desplazamiento_canvas = 7.5;
altura_actual_cuadrado = 500;
var alto_rectangulo = canvas.height;
var ancho_rectangulo = canvas.width;
var div_canvas = document.getElementById("div_canvas");
input_puntuacion = document.getElementById("puntuacion");
var progress = document.getElementById("progress");
//etiqueta audio
var audio = document.getElementById("audio");
//volumen
audio.volume = 0.1;
var nivel_elegido;
var sobre_bloques = false;
var salto_on;
var contador_pasadas_limpiar = 0;

var cancion1src = "files/geometry_dash_sounds/nivel 1.mp3";
var cancion2src = "files/geometry_dash_sounds/nivel 3.mp3";
var cancion3src = "files/geometry_dash_sounds/nivel 6.mp3";

//pintamos el texto inicial
context.rect(ancho_rectangulo/2-70,alto_rectangulo/2-30,150,50);
context.stroke();
context.font = "bold 20px sans-serif";
context.fillText("Click me!",ancho_rectangulo/2-40,alto_rectangulo/2);

//metodos para play y pause del audio en 2º plano
function playAudio() { 
	//volumen del audio para Melano - on Fire
	//audio.volume = 0.004;
	//otrass
	audio.volume = 0.1;
	audio.play(); 
} 
function pauseAudio() { 
	audio.volume = 0.004;
	audio.pause(); 
}
//funcion auxiliar para calcular aleatorios entre 2 numeros
function numeroAleatorio(min, max) {
  return Math.round(Math.random() * (max - min) + min);
}
//Funcion que crea un rectangulo.
 function rect(x, y, w, h, color,context){
    context.fillStyle = color;
    context.fillRect(x, y, w, h);
}
//objeto para crear cuadrados(jugador)
function Cuadrado (x,y,w,h,color) {
   this.x = x;
   this.y = y;
   this.w = w;
   this.h = h;
   this.color = color;
   //velocidad 8 m/s
   this.speed = 8;

    this.update = function(){
    //console.log('Nuevo registro : ');
    //console.log("sobre_bloques -> "+sobre_bloques);
    //console.log('');
    //console.log("colision  bloques -> "+this.getColisionBloquesVerified());
    //console.log('');
    //console.log("colision suelo -> "+this.getColisionGround());

	    //llamamos al metodo caida cuando esta fuera de bloques y sin estar en salto ni tocando el suelo
	    if(sobre_bloques == false && this.getColisionBloquesVerified() == false && this.getColisionGround() == false && salto_on==false){
	    	this.caida();
	    }
	    
	    if(this.getColisionMapaUsable()){
	    	//cambiamos a false para activar la caida
	    	sobre_bloques = false;
	    }else if(this.getColisionMapaUsable()!=true && this.getY()< alto_rectangulo && salto_on==false){

	    }else if(this.getColision()){
	        alert("colision");
	        alert("GG WP");
	    }else if(this.getY()==alto_rectangulo+10 || this.getY()==alto_rectangulo){

	    }else{
	    	
	    }
	    //movimiento estable del jugador
    	this.x = this.x + this.speed;
   	}
    this.draw = function(contexto){
    	rect(this.x, this.y, this.w, this.h, this.color,contexto);
    }
    this.getX = function(){
        return this.x;
    }
    this.getY = function(){
        return this.y;
    }
    this.getWidth = function(){
        return this.w;
    }
    this.getHeight = function(){
        return this.h;
    }
    //colision con el mapa,osea los obstaculos con valor = 1
    this.getColision = function(){
    	var contador = 0;
        for (var i = 0; i < array_obstaculos.length; i++) {
        	 //colision completa con los bordes del mapa o "obstaculos"
        	if(this.getX() < array_obstaculos[i].getX() + array_obstaculos[i].getWidth() &&
               this.getX() + this.getWidth() > array_obstaculos[i].getX() &&
               this.getY() < array_obstaculos[i].getY() + array_obstaculos[i].getHeight() &&
               this.getHeight() + this.getY() > array_obstaculos[i].getY() && array_obstaculos[i].getValor() == "1") {
              
            return true;
            }else{
            	//sumarPuntos();
            }
      }
    }

    //colision con los bloques aereos,osea los obstaculos con valor = 2
    this.getColisionMapaUsable = function(){
    	var contador = 0;
    	//colision con los bloques tipo 2(usables)
        for (var i = 0; i < array_obstaculos.length; i++) {
            if(this.getX() < array_obstaculos[i].getX() + array_obstaculos[i].getWidth() &&
               this.getX() + this.getWidth() > array_obstaculos[i].getX() &&
               this.getY() < array_obstaculos[i].getY() + array_obstaculos[i].getHeight() &&
               this.getHeight() + this.getY() > array_obstaculos[i].getY() && array_obstaculos[i].getValor() == "2" /*&& sobre_bloques==false*/){
        		//alert("colision bloques azules");

		    	//+1 es para que este constantemente llamando a la funcion cuando choca
        		this.y = array_obstaculos[i].getY() - array_obstaculos[i].getHeight()+1;
        		sobre_bloques = true;

        		return false;
        	}else{
            	sobre_bloques = false;
            }
      	}
      
    }
    //confirmamos si hay colision con los obstaculos
    this.getColisionBloquesVerified = function(){
    	if(this.getColisionMapaUsable() == undefined){
    		return false;
    	}else{
    		return true;
    	}
    }
    //confirmamos si hay colision con el suelo
    this.getColisionGround = function(){
    	if(this.getY()+this.getHeight() > alto_rectangulo+10){
    		return true;
    	}else{
    		return false;
    	}
    }
    this.salto = function(){
     	//verificamos si se esta produciendo un salto para evitar sobre saltos
     	if(salto_on == true){
     		//alert("ya hay un salto en proceso");
     	}else{
     		var posicionX0 = cuadrado.getX();
	     	var posicionY0 = cuadrado.getY();
	     	//console.log("posicion x -> "+posicionX0+", posicion y -> "+posicionY0);
	     	//console.log(posicionY0 - alto_rectangulo/5);

	     	var intervaloSaltoArriba = setInterval(function(){
	     		salto_on = true;
	     		//if(cuadrado.getY() <= (alto_rectangulo - alto_rectangulo/5)){
	     		if(cuadrado.getY() <= (posicionY0 - alto_rectangulo/5)){
	     			//alert("fin salto");
	     			clearInterval(intervaloSaltoArriba);
	     			var intervaloSaltoAbajo = setInterval(function(){
	     				if(sobre_bloques==true){
	     					//alert("fin bajada1");
	     					clearInterval(intervaloSaltoAbajo);
	     					salto_on = false;
	     				}else if( cuadrado.getY() >= alto_rectangulo+10){
	     					//alert("fin bajada2");
	     					clearInterval(intervaloSaltoAbajo);
	     					salto_on = false;
	     				}else{
	     					//alert("sigo bajando");
	     					this.cuadrado.y = cuadrado.getY() + 10;
							this.cuadrado.x = cuadrado.getX() + 5;
	     				}
	     			},1000/FPS);
	     		}else{
	     			//alert("sigo saltando");
	     			this.cuadrado.y = cuadrado.getY() - 10;
					this.cuadrado.x = cuadrado.getX() + 5;
	     		}
	     	}, 1000/FPS);
	     	salto_on = false;
     	}
    }
    this.caida = function(){
    	//alert("cuando salgo fuera de los bloques y tengo que caer");
    	var posicionX0 = cuadrado.getX();
     	var posicionY0 = cuadrado.getY();

    	var intervaloSaltoAbajo = setInterval(function(){
    		salto_on = true;

			if(sobre_bloques==true){
				//alert("fin bajada1");
				salto_on = false;
				clearInterval(intervaloSaltoAbajo);
			}else if( cuadrado.getY() >= alto_rectangulo+10){
				//alert("fin bajada2");
				clearInterval(intervaloSaltoAbajo);
				salto_on = false;
			}else{
				//alert("sigo bajando");
				this.cuadrado.y = cuadrado.getY() + 4;
				this.cuadrado.x = cuadrado.getX() + 1.5;
			}
		},1000/FPS);

		salto_on = false;
    }
}
//funcion que acumula los puntos en un input
function sumarPuntos () {
       //var input_puntuacion = document.getElementById("puntuacion");
       //input_puntuacion.value = parseInt(input_puntuacion.value) + 1 + " puntos";
       input_puntuacion.value = parseInt(input_puntuacion.value) + 1;
   }
//funcion que inicia el juego
function init () {
	canvas = document.getElementById("canvas");
	canvas.style.marginLeft = "1px";
	contexto = canvas.getContext("2d");
	var suelo = 0;
	cuadrado = new Cuadrado(0,alto_rectangulo+10,30,30,"blue");

	intervaloHorizontal = setInterval(function(){
		canvas = document.getElementById("canvas");
		if(cuadrado.getColision()){
			//alert("fin");
			clearInterval(intervaloHorizontal);
			//mandamos un dialog para ir a la pantalla de puntuaciones
			gameEnd();
		}else{
			//le pasamos alto y ancho al metodo actualizar
			actualizar(contexto,canvas.height,canvas.width);
			//calculo de la movilidad del mapa para ajustarse a los intervalos.
			//canvas.style.marginLeft = (parseInt(canvas.style.marginLeft) - 7)+"px";
			canvas.style.marginLeft = (parseInt(canvas.style.marginLeft) - desplazamiento_canvas)+"px";
			progress.value = parseInt(progress.value) + 1;
		}
	}, 1000/FPS);
}
//Funcion que actualiza y redibujar el jugador.
function actualizar () {
    limpiar(contexto,);

    //actualizamos el cuadrado
    cuadrado.update();
    cuadrado.draw(contexto);
}
//limpiar el rastro del jugador al moverse
function limpiar (contexto,alto,ancho) {
	
    contexto.fillStyle = "white";
    rect(0, 0, 5000, 500,"white",contexto);

    sumarPuntos();

    //creamos el mapa con el objeto de la clase mapa_1.js
    array_obstaculos = [];

    if(nivel_elegido=="1"){
    	//alert("nivel 1");
    	if(contador_pasadas_limpiar > 0){

    	}else{
    		audio.src = cancion1src;
    		playAudio();
    	}
    	mundo=new Mundo("canvas",30,30); 
    }else if(nivel_elegido=="2"){
    	//alert("nivel 2");
    	if(contador_pasadas_limpiar > 0){

    	}else{
    		audio.src = cancion2src;
    		playAudio();
    	}
    	mundo=new Mundo2("canvas",30,30); 
    }else{
    	//alert("nivel 3");
    	if(contador_pasadas_limpiar > 0){

    	}else{
    		audio.src = cancion3src;
    		playAudio();
    	}
    	mundo=new Mundo3("canvas",30,30);
    }
    //mundo=new Mundo("canvas",30,30); 
    contador_pasadas_limpiar++;
}
function startGame (nivel) { 

	nivel_elegido = nivel;

	progress.style.display = 'block';
	var divPuntuacion = document.getElementById("div_dialog");
	divPuntuacion.style.display = 'block';
	var dialog = document.getElementById("dialog");
	dialog.remove();
	var canvas = document.createElement("canvas");
	canvas.id = "canvas";
	canvas.style.backgroundColor = "rgb(189, 196, 170)";

	//cambiamos la anchura maxima para hacer un mapa
	canvas.width = "5000";
	canvas.height = "500";
	canvas.onclick = "javascript:init()";
	canvas.innerHTML = "Su navegador no soporta Canvas.";
	div_canvas.appendChild(canvas);
	//playAudio();
	init();
}
//funcion que se ejecuta al iniciar
function gameStart () {
    div_canvas.innerHTML = "<dialog id='dialog' open='open' style='width: 200px; margin-top: 10%;'><p style='margin-left: 30%; margin-botom: 10%;'><b><u>Elija modo:</u></b></p>"+ 
							"<button style='margin-left: 30%;' onclick='selectLevel();'>Solo</button><br>"+
							"<button style='margin-left: 30%;' onclick='selectLevel();'>duo</button>"+
							"</dialog>";
}
//funcion que se ejecuta para seleccionar nivel
function selectLevel () {
    div_canvas.innerHTML = "<dialog id='dialog' open='open' style='width: 200px; margin-top: 10%;'><p style='margin-left: 30%; margin-botom: 10%;'><b><u>Elija modo:</u></b></p>"+ 
							"<button style='margin-left: 30%;' onclick='startGame(\"1\");'>Nivel 1</button><br>"+
							"<button style='margin-left: 30%;' onclick='startGame(\"2\");'>Nivel 2</button><br>"+
							"<button style='margin-left: 30%;' onclick='startGame(\"3\");'>Nivel 3</button>"+
							"</dialog>";
}
//funcion que se ejecuta al iniciar
function gameEnd () {
	pauseAudio();
    div_canvas.innerHTML = "<dialog id='dialog' open='open' style='width: 250px; margin-top: 10%;'><p style='margin-left: 30%; margin-botom: 10%;'><b><u>Fin del juego!</u></b></p>"+ 
    						"<p style='margin-left: 8%; margin-botom: 10%;'>Puntuacion -> <b>"+document.getElementById("puntuacion").value+"</u></b></p>"+
    						"<a href='acciones/enviar_puntuacion.php?puntuacion="+document.getElementById("puntuacion").value+"&nivel="+1+"'><button style='margin-left: 10%;' onclick=''>Enviar puntuacion</button></a><br>"+
							"<a href='puntuaciones/puntuaciones.php'><button style='margin-left: 10%;' onclick=''>pantalla de puntuaciones</button></a><br>"+
							"</dialog>";
}

//capturamos el evento de las teclas y llamamos al metodo para saltar
function getEvent(event){
    var evento = window.event;
    if(evento.type == "keydown" && evento.keyCode == 32){
        //alert("onkeyDown barra espaciadora");
        
       if(cuadrado.getY() < alto_rectangulo){

       	sobre_bloques = false;
       	cuadrado.salto();
       	sobre_bloques = false;

       }else{
       	sobre_bloques = false;
       	cuadrado.salto();
       	sobre_bloques = false;
       }
      
    }
}
window.onload = function() { //acceso a los eventos.
document.onkeyup = getEvent;
document.onkeypress = getEvent;
document.onkeydown = getEvent;
}


