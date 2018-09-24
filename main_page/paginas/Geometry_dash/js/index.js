
var canvas = document.getElementById("canvas");
var context = canvas.getContext("2d");
var alto_rectangulo = canvas.height;
var ancho_rectangulo = canvas.width;
var div_canvas = document.getElementById("div_canvas");
numeroObstaculos = numeroAleatorio(1,3);
var array_obstaculos = [];
input_puntuacion = document.getElementById("puntuacion");
var progress = document.getElementById("progress");
//pintamso el texto inicial
context.rect(ancho_rectangulo/2-70,alto_rectangulo/2-30,150,50);
context.stroke();
context.font = "bold 20px sans-serif";
context.fillText("Click me!",ancho_rectangulo/2-40,alto_rectangulo/2);

//metodo para crear obstaculos
/*
function crearObstaculos (contexto) {
	var contador = 100;
	var contador2 = 50;
	
	for (var i = 0; i < 2; i++) {
		if(numeroObstaculos==1){
			obstaculo = new Obstaculo(ancho_rectangulo/2,ancho_rectangulo+30,30,30,"red");
			obstaculo.draw(contexto);
			array_obstaculos.push(obstaculo);
		}else if(numeroObstaculos==2){
			obstaculo = new Obstaculo(ancho_rectangulo/2-contador,alto_rectangulo-30,30,30,"red");
			obstaculo.draw(contexto);
			array_obstaculos.push(obstaculo);
		}else{
			obstaculo = new Obstaculo(ancho_rectangulo/3-contador2,alto_rectangulo-30,30,30,"red");
			obstaculo.draw(contexto);
			array_obstaculos.push(obstaculo);
		}
		contador = contador - 50;
		contador2 = contador2 + 50;
	}
}

//hacer el mapa
//objeto para crear mapa sobre el que andar
function mapaUsable (x,y,w,h,color) {
   this.x = x;
   this.y = y;
   this.w = w;
   this.h = h;
   this.color = color;

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
    this.getColision = function(){

    }
}

//objeto para crear obstaculos
function Obstaculo (x,y,w,h,color) {
   this.x = x;
   this.y = y;
   this.w = w;
   this.h = h;
   this.color = color;

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
    this.getColision = function(){

    }
}
*/
//objeto para crear cuadrados
function Cuadrado (x,y,w,h,color) {
   this.x = x;
   this.y = y;
   this.w = w;
   this.h = h;
   this.color = color;
   //velocidad 8 m/s
   this.speed = 8;

    this.update = function(){
    
    if(this.getColision()){
        //this.dy = -this.dy;
        //this.dx = -this.dx;
        alert("colision");
        alert("GG WP");
    }
    
    this.x = this.x + this.speed;
    console.log("x = "+this.x);
    console.log("y = "+this.y);
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
    this.getColision = function(){
    	var contador = 0;
        for (var i = 0; i < array_obstaculos.length; i++) {
            if (this.getX() < array_obstaculos[i].getX() + array_obstaculos[i].getWidth() &&
               this.getX() + this.getWidth() > array_obstaculos[i].getX() &&
               this.getY() < array_obstaculos[i].getY() + array_obstaculos[i].getHeight() &&
               this.getHeight() + this.getY() > array_obstaculos[i].getY()) {
                
               
            return true;
            
            }else{
            	//sumarPuntos();
            }
      }
    }
    this.saltoVertical = function(){
    	//usando la formula de tiro vertical de fisica
    	var v0 = 100;
    	var vf = 60;
    	var t = 2;
    	var y1 = 0;
    	var y2 = 100;

    	//subida
		intervalId = setInterval(function(){
			cuadrado.y = cuadrado.getY() - 10;

			if(cuadrado.getY() <= 370){
				//alert("fin");
				clearInterval(intervalId);
				intervalId2 = setInterval(function(){
				cuadrado.y = cuadrado.getY() + 10;

				if(cuadrado.getY() >= 470){
					//alert("fin");
					clearInterval(intervalId2);
				}

			}, 1000/60);
			}

		}, 1000/60);
		 
    }
    this.tiroParabolico = function(){
    	//usando la formula de tiro Parabolico de fisica
    	var v0 = 100;
    	var vf = 60;
    	var t = 2;
    	var y1 = 0;
    	var y2 = 100;

    	//subida
    	contexto.beginPath();
		intervarlSubida = setInterval(function(){
			cuadrado.y = cuadrado.getY() - 10;
			cuadrado.x = cuadrado.getX() + 3;

			contexto.moveTo(cuadrado.getX(),cuadrado.getY());
			contexto.lineTo(cuadrado.getX()+1,cuadrado.getY()+1);
			contexto.lineWidth = 4;
			contexto.stroke();
			//hacemos la forma circular en la parte superior
			if(cuadrado.getY() == 360){
				//alert("subida");
				intervaloCircular = setInterval(function(){
					cuadrado.y = cuadrado.getY() + 2;
					cuadrado.x = cuadrado.getX() + 5;
					if(cuadrado.getY() <= 340){
						//alert("limite1");
						clearInterval(intervaloCircular);
					}
				}, 1000/60)
			}
			if(cuadrado.getY() <= 320){
				//alert("circulacion");
				intarvaloCirculacion = setInterval(function(){
					cuadrado.y = cuadrado.getY() + 1;
					cuadrado.x = cuadrado.getX() + 10;
					if(cuadrado.getY() >= 335){
						//alert("fin circulacion");
						clearInterval(intarvaloCirculacion);
					}
				},1000/60);
				clearInterval(intervarlSubida);
				invervalBajada = setInterval(function(){
				cuadrado.y = cuadrado.getY() + 10;
				cuadrado.x = cuadrado.getX() + 3;

				contexto.moveTo(cuadrado.getX(),cuadrado.getY());
				contexto.lineTo(cuadrado.getX()+1,cuadrado.getY()+1);
				contexto.lineWidth = 4;
				contexto.stroke();
				
				if(cuadrado.getY() == 326.5){
					//alert("bajada");
					
					intervaloCircular = setInterval(function(){
						cuadrado.y = cuadrado.getY() + 4;
						cuadrado.x = cuadrado.getX() + 8;

						if(cuadrado.getY() >= 400){
						//alert("limite2");
						clearInterval(intervaloCircular);
					}
					}, 1000/60);
					
				}
				
				if(cuadrado.getY() >= 470){
					//alert("suelo");
					clearInterval(invervalBajada);
					cuadrado.y = 470;
					//cuadrado.update();
				}

			}, 1000/60);
			}

		}, 1000/60);
		contexto.closePath();
    }
}
//funcion que acumula los puntos en un input
function sumarPuntos () {
       //var input_puntuacion = document.getElementById("puntuacion");
       //input_puntuacion.value = parseInt(input_puntuacion.value) + 1 + " puntos";
       input_puntuacion.value = parseInt(input_puntuacion.value) + 1;
   }
//Funcion que crea un rectangulo.
 function rect(x, y, w, h, color,context){
    context.fillStyle = color;
    context.fillRect(x, y, w, h);
}
//funcion que inicia el juego
function init () {
	canvas = document.getElementById("canvas");
	//canvas.style.marginLeft = "5%";
	canvas.style.marginLeft = "1px";
	contexto = canvas.getContext("2d");
	var suelo = 0;
	cuadrado = new Cuadrado(0,alto_rectangulo-30,30,30,"blue");
	//cuadrado.draw(contexto);

	intervaloHorizontal = setInterval(function(){
		//actualizar(contexto);
		canvas = document.getElementById("canvas");
		if(cuadrado.getColision()){
			alert("fin");
			clearInterval(intervaloHorizontal);
			//mandamos un dialog para ir a la pantalla de puntuaciones
			gameEnd();
		}else{
			//le pasamos alto y ancho al metodo actualizar
			actualizar(contexto,canvas.height,canvas.width);
			canvas.style.marginLeft = (parseInt(canvas.style.marginLeft) - 8.1)+"px";
			progress.value = parseInt(progress.value) + 1;
			console.log(progress.value);
			//console.log(canvas.style.marginLeft);
		}
	}, 1000/60);
}
//Funcion que actualiza y redibujar el jugador.
function actualizar () {
    limpiar(contexto,);
    //actualizamos el cuadrado
    cuadrado.update();
    cuadrado.draw(contexto);
    //creamos los obstaculos
    //crearObstaculos(contexto);	
    
    
    //canvas.style.marginLeft = canvas.style.marginLeft + 5;
}
//limpiar el rastro del jugador al moverse
function limpiar (contexto,alto,ancho) {
	console.log(alto+", "+ancho);
    contexto.fillStyle = "white";
    //rect(0, 0, ancho_rectangulo, alto_rectangulo,"white",contexto);
    //rect(0, 0, ancho, alto,"white",contexto);
    rect(0, 0, 5000, 500,"white",contexto);
    //creamos los obstaculos
    crearObstaculos(contexto);
    sumarPuntos();
    //mundo=new Mundo("micanvas",30,30); 
}
function startGame () { 
	progress.style.display = 'block';
	var divPuntuacion = document.getElementById("div_dialog");
	divPuntuacion.style.display = 'block';
	var dialog = document.getElementById("dialog");
	dialog.remove();
	var canvas = document.createElement("canvas");
	canvas.id = "canvas";
	canvas.style.backgroundColor = "rgb(189, 196, 170)";
	//cambiamos la anchura maxima para hacer un mapa
	/*canvas.width = "1000";*/
	canvas.width = "5000";
	canvas.height = "500";
	canvas.onclick = "javascript:init()";
	canvas.innerHTML = "Su navegador no soporta Canvas.";
	div_canvas.appendChild(canvas);
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
							"<button style='margin-left: 30%;' onclick='startGame();'>Nivel 1</button><br>"+
							"<button style='margin-left: 30%;' onclick='startGame();'>Nivel 2</button><br>"+
							"<button style='margin-left: 30%;' onclick='startGame();'>Nivel 3</button>"+
							"</dialog>";
}
//funcion que se ejecuta al iniciar
function gameEnd () {
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
        
        //metodo para hacer un salto vertical
       //cuadrado.saltoVertical();
       cuadrado.tiroParabolico();
    }
}
window.onload = function() { //acceso a los eventos.
document.onkeyup = getEvent;
document.onkeypress = getEvent;
document.onkeydown = getEvent;
}
// funcion auxiliar para calcular aleatorios entre 2 numeros
function numeroAleatorio(min, max) {
  return Math.round(Math.random() * (max - min) + min);
}

