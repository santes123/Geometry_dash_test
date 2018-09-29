//1)salto vertical con caida vertical
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

//2) salto con tiro parabolico a ojo
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
					cuadrado.y = 510;
					//cuadrado.update();
				}

			}, 1000/60);
			}

		}, 1000/60);
		contexto.closePath();
    }

//3)intento de salto con calculo parabolico

  /*
    this.salto = function(){
    	//x, y iniciales del cuadrado
    	var x0 = this.getX();
    	var x0 = this.getY();

    	//factores fijos
    	var v = 2;	// 2m/s
    	var t = 2;	// 2s
    	var g = 9.8; // gravedad

    	//velocidad en cada eje
    	var vx = 2 * cos(45);
    	var vy = 2 * sen(45);

    	//x, y en cada instante
    	var x = x0+(pow(vx, t));
    	var y = y0+(pow(vy, t))+(0.5*pow(g*t,2));

    	for (var i = 0; i <= t; i=i+0.1) {
    		
    	}
    }
    */
