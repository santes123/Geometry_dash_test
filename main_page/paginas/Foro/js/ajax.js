//AJAX

function ajax_borrado(id_entrada,seccion){
	if (window.XMLHttpRequest) {
		// code for modern browsers
		xmlhttp = new XMLHttpRequest();
	 } else {
		// code for old IE browsers
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange = parseDatos
	xmlhttp.open("POST", "../../acciones/borrar_entrada.php", true);
	
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	
	xmlhttp.send("id_entrada="+id_entrada+"&seccion="+seccion);
}

function parseDatos(){
	console.log('Ready State '+this.readyState);
	console.log('status '+this.status);

	if(this.readyState == 4 && this.status == 200 ){
		var texto = this.responseText;
		//console.log(texto);
		//refrecamos la pagina forzadamente para ver los cambios
		location.reload(true);
		/*
		console.log(this);
		var texto = this.responseText;
		var cuadro = document.createElement("p");
		//createTextNode() -> creamos directamente un nodo de texto y se lo colamos al <p>
		//var textoEspacioRespuesta = window.document.createTextNode(texto);
		//cuadro.appendChild(textoEspacioRespuesta);
		//o lo añadimos simplemente con un innerHTML
		cuadro.innerHTML = texto;

		document.body.appendChild(cuadro);
		
	*/}/*else{

	}
	*/
}