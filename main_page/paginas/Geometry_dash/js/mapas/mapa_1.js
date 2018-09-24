var canvas = document.getElementById("canvas");
var context = canvas.getContext("2d");
var alto_rectangulo = canvas.height;
var ancho_rectangulo = canvas.width;
numeroObstaculos = numeroAleatorio(1,3);
var array_obstaculos = [];
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
function crearMapa () {
 
}
// funcion auxiliar para calcular aleatorios entre 2 numeros
function numeroAleatorio(min, max) {
  return Math.round(Math.random() * (max - min) + min);
}

      function Mundo(idCanvas, anchoCelda, altoCelda){
        this.canvas=document.getElementById(idCanvas);
        this.contexto=this.canvas.getContext('2d');
        
        this.anchoCelda=anchoCelda;
        this.altoCelda=altoCelda;
        
        this.conjuntoTiles=[new Tile(this.anchoCelda,this.altoCelda,true,"white"),new Tile(this.anchoCelda,this.altoCelda,false,"black")];
        
        this.mapa= [
              [1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1], 
              [1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1], 
              [1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1], 
              [1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1],
              [1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 1], 
              [1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1],
              [1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1],
              [1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1], 
              [1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1],
              [1, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1],
              [1, 0, 0, 0, 1, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1], 
              [1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1],
            ];
        
        this.canvas.width=anchoCelda*this.mapa[0].length;
        this.canvas.height=altoCelda*this.mapa.length;
        
        this.dibujarMapa();
      }
       
      Mundo.prototype.dibujarMapa=function(){
        var y=this.mapa.length;
        var x=this.mapa[0].length;
        for (var yi=0;yi<y;yi++) {
          for (var xi=0;xi<x;xi++) {
            this.conjuntoTiles[this.mapa[yi][xi]].dibujar(this.contexto,xi,yi);
          }
        }
      };

      function Tile(ancho, alto, caminable, color){
        this.ancho=ancho;
        this.alto=alto;
        this.caminable=caminable;
        this.color=color;
        }
        Tile.prototype.dibujar=function(contexto,x,y){
        contexto.fillStyle = "#444";
        contexto.fillRect(this.ancho*x,this.alto*y,this.ancho,this.alto);
        contexto.fillStyle = this.color;
        contexto.fillRect(this.ancho*x+1,this.alto*y+1,this.ancho-2,this.alto-2);
      };

      //ejecutar codigo
      var mundo;
      window.onload=function(){
        mundo=new Mundo("micanvas",30,30);  
      };